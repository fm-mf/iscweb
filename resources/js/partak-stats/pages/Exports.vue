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
            title="Export active buddies"
            description="Export list of buddies who logged into buddy database in last months"
            href="#"
            @click="exportActiveBuddies = true"
        />

        <modal v-if="exportActiveBuddies" @cancel="exportActiveBuddies = false">
            <template slot="header">
                Export active buddies
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
            Export active buddies active in last
            <select v-model="months">
                <option v-for="item in monthsOptions" :key="item" :value="item">
                    {{ item }} months
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
