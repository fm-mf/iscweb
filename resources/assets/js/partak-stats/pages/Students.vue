<template>
  <loader
    class="students"
    :active="students.loading || counts.loading"
    absolute
  >
    <div class="row">
      <div class="col-md-6 fill-height">
        <h2>By faculty</h2>

        <stats-table :data="byFaculty" key-field="faculty" />
      </div>
      <div class="col-md-6">
        <h2>By gender</h2>

        <stats-table :data="byGender" key-field="sex" :show-histogram="false" />

        <h2>Profile stats</h2>

        <stats-table
          :data="profileStats"
          key-field="label"
          :show-histogram="false"
        />
      </div>
    </div>
  </loader>
</template>

<script>
import StatsTable from '../components/StatsTable';
import { toStatsCollection } from '../utils/collections';
import {
  cached,
  getStudents,
  getStudentCounts,
  promised,
  emptyPromised
} from '../api';

export default {
  components: {
    StatsTable
  },
  props: {
    semester: { type: String, required: true }
  },
  data: () => ({
    byFaculty: null,
    byGender: null,
    withFacebook: null,
    withWhatsapp: null,
    withAbout: null,
    withPhoto: null,
    withArrival: null,
    withProfile: null,
    students: emptyPromised(),
    counts: emptyPromised()
  }),
  computed: {
    facultyMax() {
      return (this.byFaculty || []).reduce(
        (max, item) => (item.count > max ? item.count : max),
        0
      );
    },
    genderMax() {
      return (this.byGender || []).reduce(
        (max, item) => (item.count > max ? item.count : max),
        0
      );
    },
    profileStats() {
      return {
        items: [
          { label: 'Filled profile', count: this.withProfile },
          { label: 'With arrival', count: this.withArrival },
          { label: 'With about', count: this.withAbout },
          { label: 'With photo', count: this.withPhoto },
          { label: 'With Whatsapp', count: this.withWhatsapp },
          { label: 'With Facebook', count: this.withFacebook }
        ],
        min: 0,
        max: this.withProfile,
        total: this.withProfile
      };
    }
  },
  watch: {
    semester() {
      return this.load();
    }
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.students = promised(cached(getStudents(this.semester), false)).then(
        data => {
          this.byFaculty = this.updateFaculties(data.by_faculty);
          this.byGender = toStatsCollection(data.by_gender);
          this.withFacebook = data.with_facebook;
          this.withWhatsapp = data.with_whatsapp;
          this.withAbout = data.with_about;
          this.withPhoto = data.with_photo;
        }
      );
      this.counts = promised(
        cached(getStudentCounts(this.semester)),
        false
      ).then(data => {
        this.withArrival = data.students_with_arrival;
        this.withProfile = data.students_with_profile;
      });
    },
    updateFaculties(byFaculty) {
      const col = toStatsCollection(byFaculty);
      col.items = col.items.map(item => ({
        ...item,
        children: () =>
          cached(getStudents(this.semester, item.faculty)).then(data =>
            toStatsCollection(
              data.by_gender.map(item => ({ ...item, faculty: item.sex }))
            )
          )
      }));
      return col;
    }
  }
};
</script>

<style lang="scss" scoped>
.fill-height {
  min-height: 300px;
}
</style>
