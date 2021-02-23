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
import RegionMap from "../Sections/RegionMap";
import SidebarLayout from "../Layouts/SidebarLayout";

export default {
    name: 'Home',
    components: {
        RegionMap,
        SidebarLayout
    },
    computed: {
        sum() {
            return this.trash.reduce((sum, el) => sum + el.percentage, 0);
        }
    },
    methods: {
        correctPercentage(percentage) {
            if (this.sum === 100) {
                return percentage;
            }
            return ((this.sum < 100) ? percentage * (100 / this.sum) : percentage / (this.sum / 100)).toFixed(2);

        }
    },
    mounted() {
        this.$store.commit('setCurrentPage', this.currentPage);
    },
    props: {
        currentPage: {
            type: String,
            required: true
        },
        trash: {
            type: Array,
            required: true
        },
        regionDumpData: {
            type: Array,
            required: true
        }
    }
}
</script>
