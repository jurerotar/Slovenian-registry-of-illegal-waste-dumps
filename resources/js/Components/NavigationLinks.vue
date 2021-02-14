<template>
    <div
        class="flex flex-col lg:flex-row items-start justify-start lg:justify-end lg:items-center pt-4 lg:pt-0">
        <inertia-link href="/" :class="{'underline text-green-default': currentPage === 'home'}"
                      class="mb-4 lg:mb-0 md:mr-4 font-semibold dark:text-white hover:text-green-default">
            Domov
        </inertia-link>
        <inertia-link href="/zemljevid" :class="{'underline text-green-default': currentPage === 'map'}"
                      class="mb-4 lg:mb-0 lg:mr-4 font-semibold dark:text-white">
            Zemljevid
        </inertia-link>
        <inertia-link href="/izvoz" :class="{'underline text-green-default': currentPage === 'export'}"
                      class="mb-4 lg:mb-0 lg:mr-4 font-semibold dark:text-white">
            Izvoz podatkov
        </inertia-link>
        <inertia-link href="/prijava" class="mb-4 lg:mb-0 lg:mr-4 font-semibold rounded-lg px-4 py-2
                bg-green-default text-white text-center hover:bg-green-default-darker">
            Prijavi odlagališče
        </inertia-link>
        <DarkmodeToggle class="mb-4 lg:mb-0 lg:mr-4"></DarkmodeToggle>
        <!--        <a href="https://github.com/jurerotar/Ocistimo-Slovenijo">-->
        <!--            <Icon :type="'github'" :color="'black'" class="h-8 w-8"></Icon>-->
        <!--        </a>-->
    </div>
</template>

<script>
import DarkmodeToggle from "./DarkmodeToggle";
import Icon from "./Icon";

export default {
    name: "NavigationLinks.vue",
    components: {
        DarkmodeToggle,
        Icon,
    },
    computed: {
        currentPage() {
            return this.$store.state.currentPage;
        },
    }
}
</script>
