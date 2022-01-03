<template>
    <div class="flex flex-col">
        <app-head />
        <interactive-map />
        <!--        <ul class="">-->
        <!--            <li-->
        <!--                v-for="type in props.trash"-->
        <!--                :key="type.id"-->
        <!--                class=""-->
        <!--            >-->
        <!--                <p>-->
        <!--                    {{ type.name }} : {{ type.volume }} m³ ({{ correctPercentage(type.percentage) }}%)-->
        <!--                </p>-->
        <!--            </li>-->
        <!--        </ul>-->
    </div>
</template>

<script
    setup
    lang="ts"
>
import AppHead from "@/js/components/common/AppHead.vue";
import InteractiveMap from "@/js/components/public-views/home/interactive-map/InteractiveMap.vue";
import {usePage} from "@inertiajs/inertia-vue3";
import {InertiaPageProps} from "@/js/types/inertia";

const {statisticsData} = usePage<InertiaPageProps>().props.value;
console.log(statisticsData)
// const statisticsData = computed<StatisticsData[]>(() => page.props.value.statisticsData);

// const sum = computed(() => props.trash.reduce((sum: number, el: any) => sum + el.percentage, 0));
// const correctPercentage = (percentage: number): string => {
//     return ((sum.value < 100) ? percentage * (100 / sum.value) : percentage / (sum.value / 100)).toFixed(2);
// }
</script>
