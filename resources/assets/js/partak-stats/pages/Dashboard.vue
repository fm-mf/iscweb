<template>
  <loader
    class="stats-dashboard"
    :active="activeBuddies.loading || buddies.loading || counts.loading"
    absolute
  >
    <div class="stats clearfix">
      <value-display
        label="Total buddies"
        :value="buddies.data && buddies.data.length"
        note="buddies with >0 students this semester"
      />

      <value-display
        label="Most students per buddy"
        :value="
          buddies.data &&
            (buddies.data.length > 0
              ? buddies.data[0].exchange_students_count
              : '-')
        "
        :note="
          buddies.data &&
            buddies.data.length > 0 &&
            `${buddies.data[0].last_name}, ${buddies.data[0].first_name}`
        "
      />

      <value-display
        label="Avg students per buddy"
        :value="
          buddies.data &&
            (buddies.data.length
              ? Math.round((studentsWithBuddy / buddies.data.length) * 10) / 10
              : '-')
        "
      />
    </div>

    <div class="stats clearfix">
      <value-display label="Arriving students" :value="arrivingStudents" />

      <value-display
        label="Students with a buddy"
        :value="studentsWithBuddy"
        :note="
          studentsWithFilledProfile > 0
            ? `${percentage(
                studentsWithBuddy,
                studentsWithFilledProfile
              )} of students with filled profile`
            : null
        "
      />

      <value-display
        label="Students with filled profile"
        :value="studentsWithFilledProfile"
        :note="
          arrivingStudents > 0
            ? `${percentage(
                studentsWithFilledProfile,
                arrivingStudents
              )} of arriving students`
            : null
        "
      />
    </div>

    <div class="stats clearfix">
      <value-display
        label="Students from previous semester"
        :value="studentsFromPreviousSemester"
        note="staying here for more than one semester"
      />

      <value-display
        label="Buddies active in last 6 months"
        :value="activeBuddies.data && activeBuddies.data.length"
        note="by last login time"
      />
    </div>
  </loader>
</template>

<script>
import ValueDisplay from '../components/ValueDisplay';
import {
  getActiveBuddies,
  getBuddies,
  getStudentCounts,
  cached,
  promised,
  emptyPromised
} from '../api';

export default {
  components: { ValueDisplay },
  props: {
    semester: { type: String, required: true }
  },
  data: () => ({
    activeBuddies: emptyPromised(),
    buddies: emptyPromised(),
    counts: emptyPromised(),
    arrivingStudents: null,
    studentsWithFilledProfile: null,
    studentsWithBuddy: null,
    studentsFromPreviousSemester: null
  }),
  computed: {
    countsData() {
      return this.counts.data;
    }
  },
  watch: {
    semester() {
      return this.load();
    },
    countsData() {
      if (this.countsData) {
        this.arrivingStudents = this.countsData.arriving_students;
        this.studentsWithFilledProfile = this.countsData.students_with_profile;
        this.studentsWithBuddy = this.countsData.students_with_buddy;
        this.studentsFromPreviousSemester = this.countsData.students_from_previous;
      }
    }
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.activeBuddies = promised(cached(getActiveBuddies()));
      this.buddies = promised(cached(getBuddies(this.semester)));
      this.counts = promised(cached(getStudentCounts(this.semester)));
    },
    percentage(value, total) {
      return Math.round((value * 100) / total) + ' %';
    }
  }
};
</script>

<style lang="scss" scoped>
.stats {
  padding: 1rem 3rem;
}
</style>
