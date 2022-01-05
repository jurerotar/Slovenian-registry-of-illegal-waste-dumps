<template>
  <input
    type="checkbox"
    :checked="props.checked"
    class="rounded border-gray-300 text-blue-500 shadow-sm
           accessible:border-box-highlight-gray
           focus:border-box-highlight-blue"
    @change="updateValue"
  >
</template>

<script setup lang="ts">
export interface AppCheckboxProps {
    checked: boolean
}

const props = withDefaults(defineProps<AppCheckboxProps>(), {
    checked: true
});
const emit = defineEmits(['update:checked']);

const updateValue = () => emit('update:checked', props.checked);

</script>
