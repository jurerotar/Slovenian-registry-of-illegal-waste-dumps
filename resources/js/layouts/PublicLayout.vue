<template>
    <div class="max-w-screen-2xl mx-auto relative">
        <!-- Top navigation -->
        <nav
            class="bg-white p-2 lg:px-4 colors-transition dark:bg-zinc-800 border-b-default shadow-sm dark:shadow-none
            border-gray-300 dark:border-transparent border-solid flex flex-row items-center justify-center md:justify-end
            relative lg:fixed lg:left-0 lg:top-0 w-full lg:max-w-[calc(100%-18rem)] h-16 z-10 lg:ml-72"
        >
            <!-- Logo displays only on tablets and mobiles -->
            <div
                v-if="!isLgUp"
                class="flex flex-row items-center justify-between w-full h-full"
            >
                <app-logo />
                <hamburger-menu />
            </div>
            <top-navigation v-if="isLgUp" />
        </nav>
        <!-- Sidebar -->
        <nav
            class="flex sidebar transform lg:translate-x-0 duration-300 transition-all z-10 h-full shadow-2xl dark:shadow-none
            fixed left-0 top-0 flex-col lg:w-72 bg-white dark:bg-zinc-800 overflow-y-auto p-2 md:p-4 gap-4"
            :class="[sidebarExtended ? 'translate-x-0' : '-translate-x-full']"
        >
            <app-logo />
            <!-- Top navigationLinks displays only on tablets and mobile devices -->
            <top-navigation v-if="!isLgUp" />
            <side-navigation
                :navigation="navigation"
            />
            <github-button />
        </nav>
        <!-- Main container -->
        <app-container>
            <slot />
        </app-container>
    </div>
</template>

<script
    setup
    lang="ts"
>
import HamburgerMenu from "@/js/components/common/navigation/HamburgerMenu.vue";
import AppContainer from "@/js/components/common/AppContainer.vue";
import {setResizeHandler} from "@/js/helpers/functions";
import {computed, ref} from 'vue';
import {useStore} from 'vuex';
import {State} from "@/js/stores/store";
import axios from "axios";
import AppLogo from "@/js/components/common/AppLogo.vue";
import {Region} from "@/js/types/models";
import SideNavigation from "@/js/components/common/navigation/SideNavigation.vue";
import TopNavigation from "@/js/components/common/navigation/TopNavigation.vue";
import GithubButton from "@/js/components/common/buttons/GithubButton.vue";

setResizeHandler();

const store = useStore<State>();
const sidebarExtended = computed<boolean>(() => store.state.appState.sidebarExtended);
const isLgUp = computed<boolean>(() => store.getters.isLgUp);
const navigation = ref<Region[] | null>(null);

// Fetch navigation
(async (): Promise<void> => {
    try {
        const response = await axios.get<Region[]>('/api/public/navigation');
        navigation.value = response.data;
    } catch (e) {
        console.log('Error fetching navigation data');
    }
})();

</script>

<style scoped>
summary:hover h3 {
    color: rgb(156, 163, 175);
}
</style>
