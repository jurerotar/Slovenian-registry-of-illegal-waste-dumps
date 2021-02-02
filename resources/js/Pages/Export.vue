<template>
    <SidebarLayout>
        <div class="bvb">
            <p class="">Regije</p>
            <a :href="`/download?rid=${region.id}`" target="_blank" class="" v-for="region in regionIds"
               :key="region.id">
                {{ region.name }}
            </a>
            <p class="">Občine</p>
            <a :href="`/download?mid=${municipality.id}`" target="_blank" class=""
               v-for="municipality in municipalityIds"
               :key="municipality.id">
                {{ municipality.name }}
            </a>
        </div>

    </SidebarLayout>
</template>


<script>
import SidebarLayout from "../Layouts/SidebarLayout";

export default {
    name: 'Export',
    components: {
        SidebarLayout,
    },
    data() {
        return {
            regions: window.globalData.regions,
        }
    },
    computed: {
        regionIds() {
            return this.regions.map(reg => {
                return {
                    id: reg.id,
                    name: reg.name
                }
            });
        },
        municipalityIds() {
            return this.regions.map(reg => {
                return reg.municipalities;
            }).flat();
        },
    },
    mounted() {
        console.log(this.municipalityIds);
    }
}
</script>

<style>
.bvb * {
    display: flex
}
</style>
