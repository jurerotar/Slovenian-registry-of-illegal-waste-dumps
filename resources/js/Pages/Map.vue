<template>
    <sidebar-layout :current-page="currentPage"></sidebar-layout>
</template>

<script>
import SidebarLayout from "../Layouts/SidebarLayout";

export default {
    name: "Map",
    components: {
        SidebarLayout
    },
    mounted() {
        this.$store.commit('setCurrentPage', this.currentPage);
    },
    props: {
        currentPage: {
            type: String,
            required: true
        }
    },
}
</script>

<style scoped>

</style>
