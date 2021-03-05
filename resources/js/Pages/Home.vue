<template>
    <sidebar-layout>
        <div class="div">
            <region-map :regionDumpData="regionDumpData"></region-map>
            <ul class="">
                <li class="" v-for="type in trash" :key="type.id">
                    <p>{{ type.name }} : {{ type.volume }} m³ ({{ correctPercentage(type.percentage) }}%)</p>
                </li>
            </ul>
        </div>
    </sidebar-layout>
</template>

<script>
import shared from '../Plugins/meta';
import RegionMap from "../Sections/RegionMap";
import SidebarLayout from "../Layouts/SidebarLayout";

export default {
    name: 'Home',
    components: {
        RegionMap,
        SidebarLayout
    },
    created() {
        shared.meta(this.meta.title, this.meta.desc);
        this.$store.commit('setCurrentPage', this.meta.page);
    },
    computed: {
        /**
         * Calculates sum of percentages
         * @returns {float}
         */
        sum() {
            return this.trash.reduce((sum, el) => sum + el.percentage, 0);
        }
    },
    methods: {
        /**
         * Percentages may not sum to 100% because of rounding, this method scales each percentage either
         * up or down based on the difference to 100%.
         * @param {float} percentage
         * @returns {string} - Return as string to prevent additional rounding
         */
        correctPercentage(percentage) {
            return ((this.sum < 100) ? percentage * (100 / this.sum) : percentage / (this.sum / 100)).toFixed(2);
        }
    },
    props: {
        meta: {
            type: Object,
            required: true
        },
        trash: {
            type: Array,
            required: true
        },
        regionDumpData: {
            type: Array,
            required: true
        },
        errors: {
            type: Object,
            required: false,
            default: {}
        }
    }
}
</script>
