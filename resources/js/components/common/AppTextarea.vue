<template>
  <textarea
    ref="input"
    :value="props.modelValue"
    @input="updateValue($event.target.value)"
  />
</template>

<script setup lang = "ts">
export interface AppTextareaProps {
    modelValue: string
}

const props = withDefaults(defineProps<AppTextareaProps>(), {
    modelValue: ''
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (value: string) => emit('update:modelValue', value);
</script>
