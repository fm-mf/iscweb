<template>
    <div>
        <div class="stats-content container">
            <div class="stats-filter">
                <select
                    v-if="semesters.data"
                    v-model="semester"
                    class="form-control"
                >
                    <option
                        v-for="item in semesters.data"
                        :key="item.id"
                        :value="item.id"
                    >
                        {{ item.name }}
                    </option>
                </select>
            </div>

            <div v-if="error" class="error">
                <p>{{ error.message }}</p>
                <div v-if="error.error" class="error-desc">
                    <div>
                        <strong>URL:</strong>
                        {{ error.error.request.responseURL }}
                    </div>
                    <div>
                        <strong>Error:</strong>
                        {{ error.error.response.status }}
                    </div>
                </div>
                <div class="btn btn-warning" @click="error = null">
                    OK
                </div>
            </div>
            <router-view :semester="semester" />
        </div>
    </div>
</template>

<script>
import {
    cached,
    getSemesters,
    promised,
    addErrorListener,
    removeErrorListener
} from './api';

export default {
    props: {
        currentSemester: { type: String, required: true }
    },
    data() {
        return {
            semester: this.currentSemester,
            semesters: promised(cached(getSemesters())),
            error: null
        };
    },
    created() {
        addErrorListener(this.catchError);

        // UGLY HACK START
        const navs = {
            'stats-dashboard': '/',
            'stats-arrivals': '/arrivals',
            'stats-buddies': '/buddies',
            'stats-students': '/students',
            'stats-countries': '/countries',
            'stats-history': '/history',
            'stats-exports': '/exports'
        };

        Object.entries(navs).forEach(([id, url]) => {
            const element = document.getElementById(id);
            element?.addEventListener('click', e => {
                e.preventDefault();
                e.stopPropagation();

                Object.keys(navs).forEach(n => {
                    document
                        .getElementById(n)
                        ?.parentElement.classList.remove('active');
                });

                element.parentElement.classList.add('active');

                $('#navbarNav').collapse('toggle');
                this.$router.push(url);
            });
        });
        // UGLY HACK END
    },
    destroyed() {
        removeErrorListener(this.catchError);
    },
    methods: {
        catchError(e) {
            if (e.response && e.response.status === 401) {
                window.location.reload();
            } else {
                this.error = {
                    message: `There was an error when loading data from server.`,
                    error: e
                };
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.stats-content {
    padding: 1rem 3rem;
    position: relative;
}

.stats-filter {
    margin-bottom: 2rem;
}

.error {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 1rem 3rem;
    background: rgba(255, 50, 50, 0.9);
    color: #fff;
    z-index: 2;
}

.error-desc {
    margin: 1rem;
}
</style>
