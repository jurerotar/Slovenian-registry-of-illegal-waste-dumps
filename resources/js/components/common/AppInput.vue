<template>
  <input
    ref="input"
    class="h-10"
    :value="props.modelValue"
    @input="updateValue($event.target.value)"
  >
</template>

<script setup lang = "ts">
export interface AppInputProps {
    modelValue: string
}

const props = withDefaults(defineProps<AppInputProps>(), {
    modelValue: ''
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (value: string) => emit('update:modelValue', value);
</script>
