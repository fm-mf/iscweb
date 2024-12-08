<template>
    <div>
        <card
            icon="fas fa-file-excel"
            title="Export CE candidates"
            :description="
                `Exchange students who expressed interest in representing their country on Culture Evening (when filling out their profile) in ${semester}`
            "
            :href="
                `/partak/stats/export/semester/${semester}/culture-evening-candidates`
            "
        />

        <card
            icon="fas fa-file-excel"
            title="Export active Buddies"
            :description="
                `Export list Buddies who have at least one Exchange student in ${semester} semester and agreed to receive information e-mails`
            "
            :href="
                `/partak/stats/export/semester/${semester}/buddies`
            "
        />

        <card
            icon="fas fa-file-excel"
            title="Export Buddies"
            description="Export list of verified Buddies who logged into Buddy database in last months and agreed to receive information e-mails"
            @click="exportActiveBuddies = true"
        />

        <modal v-if="exportActiveBuddies" @cancel="exportActiveBuddies = false">
            <template slot="header">
                Export Buddies
            </template>
            <template slot="footer">
                <a
                    class="btn btn-secondary"
                    @click="exportActiveBuddies = false"
                >
                    Cancel
                </a>

                <a
                    class="btn btn-primary"
                    :href="
                        `/partak/stats/export/active-buddies?months=${months}`
                    "
                    target="_blank"
                    @click="exportActiveBuddies = false"
                >
                    Export
                </a>
            </template>
            Export Buddies logged-in during the last
            <select v-model="months">
                <option v-for="item in monthsOptions" :key="item" :value="item">
                    {{ item }} {{ item === 1 ? 'month' : 'months' }}
                </option>
            </select>
        </modal>
    </div>
</template>

<script>
import Modal from '../components/Modal';
import Card from '../components/Card';

export default {
    components: {
        Card,
        Modal
    },
    props: {
        semester: { type: String, required: true }
    },
    data() {
        const monthsOptions = [];
        for (let i = 1; i <= 12; i++) {
            monthsOptions.push(i);
        }

        return {
            months: 4,
            monthsOptions,
            exportActiveBuddies: false
        };
    }
};
</script>

<style></style>
