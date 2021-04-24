<template>
    <!-- Top navigation -->
    <nav class="bg-white p-2 lg:px-4 duration-300 transition-colors dark:bg-dark-nav border-b-default
            border-gray-300 dark:border-transparent border-solid flex flex-row items-center justify-center md:justify-end
            relative lg:fixed lg:left-0 lg:top-0 w-full lg:max-w-nav h-16 z-10 lg:ml-72">
        <!-- Logo displays only on tablets and mobiles -->
        <div class="flex flex-row items-center justify-between w-full h-full" v-if="width <= breakpoints.md">
            <logo></logo>
            <hamburger-menu></hamburger-menu>
        </div>
        <navigation-links v-if="width > breakpoints.md"></navigation-links>
    </nav>
    <!-- Sidebar -->
    <nav class="sidebar transform  lg:translate-x-0 duration-300 transition-all z-10 h-full shadow-2xl dark:shadow-none fixed left-0
            top-0 flex-col lg:w-72 lg:flex bg-white dark:bg-dark-nav overflow-y-auto p-2 md:p-4"
         :class="[extended ? 'translate-x-0' : '-translate-x-full']">
        <logo></logo>
        <!-- NavigationLinks displays only on tablets and mobiles -->
        <navigation-links v-if="width <= breakpoints.md" class="mb-4"></navigation-links>
        <municipality-links-by-region></municipality-links-by-region>
    </nav>
    <!-- Main container -->
    <main-container>
        <slot></slot>
    </main-container>
</template>

<script>
import Logo from "../Components/Logo";
import HamburgerMenu from "../Components/HamburgerMenu";
import NavigationLinks from "../Sections/NavigationLinks";
import MainContainer from "../Sections/MainContainer.vue";
import MunicipalityLinksByRegion from "../Sections/MunicipalityLinksByRegion";

export default {
    name: "SidebarLayout",
    components: {
        MunicipalityLinksByRegion,
        Logo,
        HamburgerMenu,
        NavigationLinks,
        MainContainer
    },
    data() {
        return {
            regions: window.globalData.regions,
        }
    },
    computed: {
        width() {
            return this.$store.state.width;
        },
        breakpoints() {
            return this.$store.state.breakpoints;
        },
        extended() {
            return this.$store.state.sidebarExtended;
        }
    },
    methods: {
        setWidth() {
            this.$store.commit('setWidth', window.innerWidth);
        },
        setHeight() {
            this.$store.commit('setHeight', window.innerHeight);
        },
        toggleSidebar() {
            this.$store.commit('setSidebarExtended', !this.extended);
        }
    },
    mounted() {
        this.setHeight();
        this.setWidth();
        window.addEventListener('resize', () => {
            this.setHeight();
            this.setWidth();
        });
    }
}
</script>

<style scoped>
summary:hover h3 {
    color: rgb(156, 163, 175);
}
</style>
