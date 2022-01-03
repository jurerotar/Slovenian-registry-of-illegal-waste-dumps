<template>
    <div class="flex flex-col lg:flex-row items-start justify-start lg:justify-end lg:items-center gap-4">
        <inertia-link
            v-for="link in links"
            :key="link.name"
            :href="link.href"
            class="font-semibold dark:text-white flex py-1 md:py-0 w-full md:w-auto colors-transition"
            :class="[{'underline': link.href === currentUrl}]"
            tabindex="0"
            @click="toggleSidebar()"
        >
            {{ link.label }}
        </inertia-link>
        <app-link-button :href="'/report-dump'">
            Prijavi odlagališče
        </app-link-button>
        <darkmode-toggle />
    </div>
</template>

<script
    setup
    lang="ts"
>
import DarkmodeToggle from "@/js/components/common/navigation/DarkmodeToggle.vue";
import {useStore} from 'vuex';
import {State} from "@/js/stores/store";
import AppLinkButton from "@/js/components/common/buttons/AppLinkButton.vue";
import {faGithub} from "@fortawesome/free-brands-svg-icons";
import {library} from "@fortawesome/fontawesome-svg-core";
import {computed} from "vue";

library.add(faGithub);

const store = useStore<State>();
// TODO: Style the underline
const currentUrl = computed<string | null>(() => store.state.appState.currentUrl);
const toggleSidebar = () => store.commit('appState/setSidebarExtended', false);

interface Links {
    href: string;
    name: string;
    label: string;
}

const links: Links[] = [
    {
        href: '/',
        name: 'home',
        label: 'Domov',
    },
    {
        href: '/map',
        name: 'map',
        label: 'Zemljevid',
    },
    {
        href: '/export',
        name: 'export',
        label: 'Izvoz podatkov',
    }
];


</script>
