<template>
    <SidebarLayout :currentPage="currentPage">
        <RegionMap :dumpsByRegion = "dumpsByRegion"></RegionMap>
        <ul class="">
            <li class="" v-for="type in trash" :key="type.id">
                <p>{{ type.name }} : {{ type.volume }} m³ ({{ correctPercentage(type.percentage) }}%)</p>
            </li>
        </ul>
    </SidebarLayout>
</template>

<script>
import RegionMap from "../Components/RegionMap";
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
            return ((this.sum < 100) ? percentage * (100 / this.sum) : percentage / (this.sum / 100)).toFixed(2);

        }
    },
    mounted() {
        console.log(this.dumpsByRegion);
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
        dumpsByRegion: {
            type: Array,
            required: true
        }
    }
}
</script>
