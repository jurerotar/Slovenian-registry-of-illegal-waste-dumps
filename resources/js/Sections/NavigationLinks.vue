<template>
    <div
        class="flex flex-col lg:flex-row items-start justify-start lg:justify-end lg:items-center pt-4 lg:pt-0">
        <inertia-link v-for="link in links" :key="link.id" @click.native="toggleSidebar()" :href="link.href"
                      class="mb-4 lg:mb-0 md:mr-4 font-semibold dark:text-white"
                      :class="[{'underline': currentPage === link.slug}, link.classes]"
        >
            {{ link.text }}
        </inertia-link>
        <darkmode-toggle class="mb-4 lg:mb-0 lg:mr-4"></darkmode-toggle>
        <!--        <a href="https://github.com/jurerotar/Ocistimo-Slovenijo">-->
        <!--            <Icon :type="'github'" :color="'black'" class="h-8 w-8"></Icon>-->
        <!--        </a>-->
    </div>
</template>

<script>
import DarkmodeToggle from "../Components/DarkmodeToggle";
import Icon from "../Components/Icon";

export default {
    name: "NavigationLinks.vue",
    components: {
        DarkmodeToggle,
        Icon,
    },
    data() {
        return {
            links: [
                {
                    id: 0,
                    href: '/',
                    slug: 'domov',
                    text: 'Domov',
                    classes: ''
                },
                {
                    id: 1,
                    href: '/zemljevid',
                    slug: 'zemljevid',
                    text: 'Zemljevid',
                    classes: ''
                },
                {
                    id: 2,
                    href: '/izvoz',
                    slug: 'izvoz',
                    text: 'Izvoz podatkov',
                    classes: ''
                },
                {
                    id: 3,
                    href: '/prijava',
                    slug: 'prijava',
                    text: 'Prijavi odlagališče',
                    classes: 'rounded-lg px-4 py-2 bg-green-default text-white text-center hover:bg-green-default-darker'
                }
            ]
        }
    },
    computed: {
        currentPage() {
            return this.$store.state.currentPage;
        },
    },
    methods: {
        toggleSidebar() {
            this.$store.commit('setSidebarExtended', false);
        }
    },
}
</script>
