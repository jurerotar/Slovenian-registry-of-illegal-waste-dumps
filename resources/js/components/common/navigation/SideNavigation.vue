<template>
    <div class="">
        <ul
            v-if="props.navigation"
            class="flex flex-col gap-1 md:gap-2"
        >
            <li
                v-for="region in props.navigation"
                :key="region.id"
            >
                <extendable
                    :opened="false"
                    :summary="region.name"
                >
                    <div class="flex flex-col gap-4 w-full">
                        <!-- Region link -->
                        <div class="flex flex-col items-start justify-center w-full gap-2">
                            <navigation-tag class="bg-green-500">
                                Regija
                            </navigation-tag>
                            <ul class="flex flex-col border-l-2 border-green-500 border-solid gap-2 w-full">
                                <li class="flex flex-col justify-center items-start w-full">
                                    <inertia-link
                                        :href="`/regions/${region.slug}`"
                                        class="flex dark:text-white colors-transition hover:text-gray-600 pl-4
                                    dark:hover:text-gray-300 font-semibold w-full"
                                        tabindex="0"
                                    >
                                        {{ region.name }}
                                    </inertia-link>
                                </li>
                            </ul>
                        </div>
                        <!-- Municipalities links -->
                        <div class="flex flex-col items-start justify-center w-full gap-2">
                            <navigation-tag class="bg-blue-500">
                                Občine
                            </navigation-tag>
                            <ul class="flex flex-col border-l-2 border-blue-500 border-solid gap-1 w-full">
                                <li
                                    v-for="municipality in region.municipalities"
                                    :key="municipality.id"
                                    class="flex flex-col justify-center items-start w-full"
                                >
                                    <inertia-link
                                        :href="`/municipalities/${municipality.slug}`"
                                        class="flex dark:text-white pl-4 colors-transition hover:text-gray-600
                                    dark:hover:text-gray-300 font-semibold w-full py-1"
                                        tabindex="0"
                                    >
                                        {{ municipality.name }}
                                    </inertia-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </extendable>
            </li>
        </ul>
        <!-- Render skeletons if navigation data is not available -->
        <ul
            v-else
            class="flex flex-col gap-1 md:gap-2"
        >
            <li
                v-for="number in 12"
                :key="number"
            >
                <app-extendable-skeleton />
            </li>
        </ul>
    </div>
</template>

<script
    setup
    lang="ts"
>
import Extendable from "@/js/components/common/AppExtendable.vue";
import {Region} from "@/js/types/models";
import NavigationTag from "@/js/components/common/navigation/components/NavigationTag.vue";
import AppExtendableSkeleton from "@/js/components/skeletons/AppExtendableSkeleton.vue";

interface SideNavigationProps {
    navigation: Region[] | null;
}

const props = defineProps<SideNavigationProps>();
</script>
