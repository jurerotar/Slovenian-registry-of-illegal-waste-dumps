<template>
    <div>
        <nav
            class="bg-white p-2 lg:px-4 duration-300 transition-colors dark:bg-dark-nav border-b-default border-gray-300 dark:border-transparent border-solid flex flex-row items-center justify-between relative lg:fixed lg:left-0 lg:top-0 w-full lg:max-w-nav h-16 z-0 lg:ml-60">
            <div class="flex flex-row items-center justify-between w-full h-full" v-if="width <= breakpoints.md">
                <Logo :orientation="'row'" :size="'max-h-10 max-w-10'"></Logo>
                <div class=""></div>
            </div>
            <div class="flex flex-row items-center justify-center" v-if="width > breakpoints.md">

            </div>
            <div class="flex flex-row items-center justify-center" v-if="width > breakpoints.md">
                <inertia-link href="/" class="mr-4 font-semibold dark:text-white duration-300 transition-colors">
                    Domov
                </inertia-link>
                <inertia-link href="/export" class="mr-4 font-semibold dark:text-white duration-300 transition-colors">
                    Izvozi podatke
                </inertia-link>
                <inertia-link href="/report"
                              class="mr-4 font-semibold rounded-lg px-6 py-3 bg-green-default text-white text-center duration-300
                                transition-colors hover:bg-green-default-darker">
                    Prijavi odlagališče
                </inertia-link>
                <DarkmodeToggle class="mr-4"></DarkmodeToggle>
                <a href="https://github.com/jurerotar/Ocistimo-Slovenijo"
                   class="h-6 w-6 github-icon duration-300 transition-colors">
                    <Icon :type="'github'" :color="'black'" :size="6"></Icon>
                </a>
            </div>
        </nav>
        <nav
            class="sidebar duration-300 transition-colors hidden z-10 h-full shadow-2xl fixed left-0 top-0 flex-col lg:w-60 lg:flex bg-white dark:bg-dark-nav overflow-y-auto">
            <Logo class="p-4 pb-0" v-if="width >= breakpoints.lg" :size="'max-h-20 max-w-20 mb-2'"></Logo>
            <ul class="mt-4">
                <li class="px-4 py-2">
                    <p class="text-gray-400 font-semibold">Regije</p>
                </li>
                <li class="px-4 py-2 hover:bg-gray-100 duration-300 transition-colors cursor-pointer"
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
        <main class="p-4 lg:ml-60 lg:mt-16 dark:bg-dark-main duration-300 transition-colors">
            <slot></slot>
        </main>
    </div>
</template>

<script>
import Logo from "../Components/Logo";
import DarkmodeToggle from "../Components/DarkmodeToggle";
import Icon from "../Components/Icon";

export default {
    name: "SidebarLayout",
    components: {
        Icon,
        DarkmodeToggle,
        Logo,
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
        }
    },
    mounted() {
        this.setHeight();
        this.setWidth();
        window.addEventListener('resize', () => {
            this.setHeight();
            this.setWidth();
        });
    },
}
</script>

<style>
.sidebar::-webkit-scrollbar {
    width: 5px;
    border-radius: 5px;
    background: inherit;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #9DC02E;
}

</style>
