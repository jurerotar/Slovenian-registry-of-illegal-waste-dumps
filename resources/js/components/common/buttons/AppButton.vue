<template>
    <button
        class="flex justify-center items-center bg-blue-500 px-4 py-2 rounded-lg colors-300 text-white font-medium
        text-center disabled:bg-blue-300 colors-transition"
        :class="[{'hover:bg-blue-600': !props.disabled}]"
        :disabled="props.disabled"
        role="button"
        tabindex="0"
    >
        <slot />
    </button>
</template>

<script setup lang = "ts">
export interface AppButtonProps {
    disabled?: boolean,
}
const props = withDefaults(defineProps<AppButtonProps>(), {
    disabled: false,
})
</script>
