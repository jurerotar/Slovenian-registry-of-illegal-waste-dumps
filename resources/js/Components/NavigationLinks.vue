<template>
    <div class="flex flex-col lg:flex-row items-start justify-start lg:justify-end lg:items-center pt-4 lg:pt-0">
        <inertia-link href="/" :class="{'text-blue-100': currentPage === 'home'}"
                      class="mb-4 lg:mb-0 md:mr-4 font-semibold dark:text-white">
            Domov
        </inertia-link>
        <inertia-link href="/map" class="mb-4 lg:mb-0 lg:mr-4 font-semibold dark:text-white">
            Zemljevid odlagališč
        </inertia-link>
        <inertia-link href="/export" class="mb-4 lg:mb-0 lg:mr-4 font-semibold dark:text-white">
            Izvoz podatkov
        </inertia-link>
        <inertia-link href="/report" class="mb-4 lg:mb-0 lg:mr-4 font-semibold rounded-lg px-4 py-2
                bg-green-default text-white text-center hover:bg-green-default-darker">
            Prijavi odlagališče
        </inertia-link>
        <DarkmodeToggle class="mb-4 lg:mb-0 lg:mr-4"></DarkmodeToggle>
    </div>
</template>

<script>
import DarkmodeToggle from "./DarkmodeToggle";

export default {
    name: "NavigationLinks.vue",
    components: {
        DarkmodeToggle,
    },
    computed: {
        currentPage() {
            return this.$store.state.currentPage;
        },
        mounted() {
            console.log(this.currentPage);
        }
    }
}
</script>
