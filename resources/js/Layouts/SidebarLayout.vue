<template>
    <div>
        <!-- Top navigation -->
        <nav class="bg-white p-2 lg:px-4 duration-300 transition-colors dark:bg-dark-nav border-b-default
            border-gray-300 dark:border-transparent border-solid flex flex-row items-center justify-center md:justify-end
            relative lg:fixed lg:left-0 lg:top-0 w-full lg:max-w-nav h-16 z-0 lg:ml-60">
            <!-- Logo displays only on tablets and mobiles -->
            <div class="flex flex-row items-center justify-between w-full h-full" v-if="width <= breakpoints.md">
                <Logo :orientation="'row'" :size="'max-h-10 max-w-10'"></Logo>
                <HamburgerMenu class=""></HamburgerMenu>
            </div>
            <NavigationLinks v-if="width > breakpoints.md"></NavigationLinks>
        </nav>
        <!-- Sidebar -->
        <nav class="sidebar transform  lg:translate-x-0 duration-300 transition-all z-10 h-full shadow-2xl dark:shadow-none fixed left-0
            top-0 flex-col lg:w-60 lg:flex bg-white dark:bg-dark-nav overflow-y-auto p-4"
             :class="[extended ? 'translate-x-0' : '-translate-x-full']">
            <Logo></Logo>
            <NavigationLinks v-if="width <= breakpoints.md"></NavigationLinks>
            <ul class="">
                <li class="py-2">
                    <p class="text-gray-400 font-semibold">Regije</p>
                </li>
                <li class="py-2 hover:bg-gray-100 duration-300 transition-colors cursor-pointer"
                    v-for="region in regions" :key="region.id">
                    <details :open="selectedRegion === region.id">
                        <summary class="outline-none" @click="setSelectedRegion(region.id)">
                            <p class="font-medium dark:text-white duration-300 transition-colors">{{ region.name }}</p>
                        </summary>
                        <ul class="ml-2">
                            <li class="px-2 py-2">
                                <p class="text-gray-400 font-semibold">Občine</p>
                            </li>
                            <li class="px-2" v-for="municipality in region.municipalities" :key="municipality.id">
                                <p class="duration-300 transition-colors">{{ municipality.name }}</p>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        </nav>
        <!-- Main container -->
        <main :class="{'pointer-events-none': extended && width < breakpoints.md}"
              class="p-4 lg:ml-60 lg:mt-16 dark:bg-dark-main duration-300 transition-colors">
            <slot></slot>
        </main>
    </div>
</template>

<script>
import Logo from "../Components/Logo";
import Icon from "../Components/Icon";
import HamburgerMenu from "../Components/HamburgerMenu";
import NavigationLinks from "../Components/NavigationLinks";

export default {
    name: "SidebarLayout",
    components: {
        Icon,
        Logo,
        HamburgerMenu,
        NavigationLinks,
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
        selectedRegion() {
            return this.$store.state.selectedRegion;
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
        setSelectedRegion(id) {
            console.log(this.selectedRegion);
            this.$store.commit('setSelectedRegion', (this.selectedRegion === id) ? null : id);
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
