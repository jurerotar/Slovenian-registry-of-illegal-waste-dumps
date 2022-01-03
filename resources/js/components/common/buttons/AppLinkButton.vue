<template>
    <inertialink
        :href="props.href"
    >
        <app-button>
            <slot />
        </app-button>
    </inertialink>
</template>

<script setup lang = "ts">
import {Link as Inertialink} from '@inertiajs/inertia-vue3';
import AppButton from "@/js/components/common/buttons/AppButton.vue";

export interface AppLinkButtonProps {
    href: string,
}
const props = defineProps<AppLinkButtonProps>();

</script>
