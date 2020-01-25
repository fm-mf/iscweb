<template>
  <div class="students">
    <div class="row">
      <div class="col-sm-6">
        <h2>By faculty</h2>

        <stats-table :data="byFaculty" key-field="faculty" />
      </div>
      <div class="col-sm-6" />
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
</template>

<script>
import StatsTable from '../components/StatsTable';
import { toStatsCollection } from '../utils/collections';
import { cached, getStudents, getStudentCounts } from '../api';

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
    withProfile: null
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
  created() {
    this.load();
  },
  methods: {
    load() {
      cached(getStudents(this.semester)).then(data => {
        this.byFaculty = toStatsCollection(data.by_faculty);
        this.byGender = toStatsCollection(data.by_gender);
        this.withFacebook = data.with_facebook;
        this.withWhatsapp = data.with_whatsapp;
        this.withAbout = data.with_about;
        this.withPhoto = data.with_photo;
      });
      cached(getStudentCounts(this.semester)).then(data => {
        this.withArrival = data.students_with_arrival;
        this.withProfile = data.students_with_profile;
      });
    },
    percentage(value, total) {
      return Math.round((value * 100) / total) + ' %';
    }
  }
};
</script>

<style lang="scss" scoped></style>
