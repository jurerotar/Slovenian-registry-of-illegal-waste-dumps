<template>
    <div>
        <!-- Top navigation -->
        <nav class="bg-white p-2 lg:px-4 duration-300 transition-colors dark:bg-dark-nav border-b-default
            border-gray-300 dark:border-transparent border-solid flex flex-row items-center justify-center md:justify-end
            relative lg:fixed lg:left-0 lg:top-0 w-full lg:max-w-nav h-16 z-0 lg:ml-72">
            <!-- Logo displays only on tablets and mobiles -->
            <div class="flex flex-row items-center justify-between w-full h-full" v-if="width <= breakpoints.md">
                <Logo></Logo>
                <HamburgerMenu></HamburgerMenu>
            </div>
            <NavigationLinks v-if="width > breakpoints.md"></NavigationLinks>
        </nav>
        <!-- Sidebar -->
        <nav class="sidebar transform  lg:translate-x-0 duration-300 transition-all z-10 h-full shadow-2xl dark:shadow-none fixed left-0
            top-0 flex-col lg:w-72 lg:flex bg-white dark:bg-dark-nav overflow-y-auto p-2 md:p-4"
             :class="[extended ? 'translate-x-0' : '-translate-x-full']">
            <Logo></Logo>
            <!-- NavigationLinks displays only on tablets and mobiles -->
            <NavigationLinks v-if="width <= breakpoints.md" class="mb-4"></NavigationLinks>
            <ul class="">
                <li v-for="region in regions" :key="region.id">
                    <details>
                        <summary class="select-none flex whitespace-nowrap justify-start flex-row items-center
                                        outline-none cursor-pointer transition-colors duration-300
                                        rounded-md py-2">
                            <div class="flex md:inline-flex whitespace-nowrap justify-start flex-row items-center">
                                <Icon :type="'angleRight'" class="details-icon inline-flex mb-0 w-8 h-8"></Icon>
                                <h3 class="dark:text-white md:ml-2 font-semibold">{{ region.name }}</h3>
                            </div>
                        </summary>
                        <div
                            class="flex flex-col items-start justify-center ml-4 pl-4 border-l-2 border-solid border-gray-300">
                             <span class="text-xs bg-green-500 rounded-md px-3 py-1 text-white font-semibold mb-2">
                                 Regija
                             </span>
                            <inertia-link :href="`/regija/${region.slug}`" class="dark:text-white font-semibold
                            inline-flex pl-4 border-l-2 border-solid border-green-500 mb-2">
                                Podatki o regiji
                            </inertia-link>
                            <span class="text-xs bg-blue-500 rounded-md px-3 py-1 text-white font-semibold mb-2">
                                Občine
                            </span>
                            <ul class="pl-4 border-l-2 border-blue-500 border-solid">
                                <li class="flex flex-col justify-center items-start mb-2"
                                    v-for="municipality in region.municipalities" :key="municipality.id">
                                    <inertia-link :href="`/obcina/${municipality.slug}`"
                                                  class="dark:text-white font-semibold">
                                        {{ municipality.name }}
                                    </inertia-link>
                                </li>
                            </ul>
                        </div>
                    </details>
                </li>
            </ul>
        </nav>
        <!-- Main container -->
        <main :class="{'pointer-events-none': extended && width < breakpoints.md}"
              class="p-4 lg:ml-72 lg:mt-16 dark:bg-dark-main duration-300 transition-colors">
            <slot></slot>
        </main>
    </div>
</template>

<script>
import Logo from "../Components/Logo";
import Icon from "../Components/Icon";
import HamburgerMenu from "../Components/HamburgerMenu";
import NavigationLinks from "../Components/NavigationLinks";
import Extendable from "../Components/Extendable";

export default {
    name: "SidebarLayout",
    components: {
        Icon,
        Logo,
        HamburgerMenu,
        NavigationLinks,
        Extendable,
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
        height() {
            return this.$store.state.height;
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
        this.$store.commit('setCurrentPage', this.currentPage);
    },
    props: {
        currentPage: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>
summary:hover h3 {
    color: rgb(156, 163, 175);
}
</style>
