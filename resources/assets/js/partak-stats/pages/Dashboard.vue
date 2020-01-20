<template>
  <div class="stats-dashboard">
    <div class="stats clearfix">
      <value-display
        label="Total buddies"
        :value="buddies && buddies.length"
        note="buddies with >0 students this semester"
      />

      <value-display
        label="Most students per buddy"
        :value="buddies && buddies[0].exchange_students_count"
        :note="buddies && `${buddies[0].last_name}, ${buddies[0].first_name}`"
      />

      <value-display
        label="Avg students per buddy"
        :value="buddies && studentsWithBuddy / buddies.length"
      />
    </div>

    <div class="stats clearfix">
      <value-display label="Arriving students" :value="arrivingStudents" />

      <value-display
        label="Students with a buddy"
        :value="studentsWithBuddy"
        :note="
          `${Math.round(
            (studentsWithBuddy * 100) / studentsWithFilledProfile
          )} % of students with filled profile`
        "
      />

      <value-display
        label="Students with filled profile"
        :value="studentsWithFilledProfile"
        :note="
          `${Math.round(
            (studentsWithFilledProfile * 100) / arrivingStudents
          )} % of arriving students`
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
        :value="activeBuddies && activeBuddies.length"
        note="by last login time"
      />
    </div>
  </div>
</template>

<script>
import ValueDisplay from '../components/ValueDisplay';
import { getActiveBuddies, getBuddies, getStudentCounts } from '../api';

export default {
  components: { ValueDisplay },
  props: {
    semester: { type: String, required: true }
  },
  data: () => ({
    activeBuddies: null,
    buddies: null,
    arrivingStudents: null,
    studentsWithFilledProfile: null,
    studentsWithBuddy: null,
    studentsFromPreviousSemester: null
  }),
  created() {
    this.load();
  },
  methods: {
    load() {
      getActiveBuddies(this.semester).then(activeBuddies => {
        this.activeBuddies = activeBuddies;
      });
      getBuddies(this.semester).then(buddies => {
        this.buddies = buddies;
      });
      getStudentCounts(this.semester).then(data => {
        this.arrivingStudents = data.arriving_students;
        this.studentsWithFilledProfile = data.students_with_profile;
        this.studentsWithBuddy = data.students_with_buddy;
        this.studentsFromPreviousSemester = data.students_from_previous;
      });
    }
  }
};
</script>

<style></style>
