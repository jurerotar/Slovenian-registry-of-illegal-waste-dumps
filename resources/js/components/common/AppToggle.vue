<template>
    <div class="toggle">
        <input
            :id="props.id"
            :checked="props.checked"
            :aria-label="label"
            class="toggle-checkbox hidden"
            type="checkbox"
            @change="updateValue"
        >
        <label
            :for="props.id"
            :class="[props.checked ? 'bg-blue-500' : 'bg-gray-300']"
            class="toggle-label cursor-pointer block w-12 h-6 rounded-full colors-300 ease-out"
        />
    </div>
</template>

<script setup lang="ts">
export interface AppToggleProps {
    id: string,
    label: string,
    checked: boolean
}
const props = defineProps<AppToggleProps>();

const emit = defineEmits(['update:checked']);

const updateValue = (event: Event) => emit('update:checked', (event.target as HTMLInputElement).checked);

</script>

<style scoped>
.toggle-label {
    position: relative;
}
.toggle-label::before {
    position: absolute;
    top: 0.125rem;
    left: 0.125rem;
    display: block;
    content: "";
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 9999%;
    background-color: white;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 40%;
    background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23a0aec0" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>');
    transition: transform 0.15s cubic-bezier(0, 0, 0.2, 1);
    transform: translateX(0);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.toggle-checkbox:checked + .toggle-label:before {
    transform: translateX(1.5rem);
    background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23a0aec0" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>');
}

.toggle.slim .toggle-label:before {
    top: -0.15rem;
    left: 0;
}
.toggle.slim .toggle-checkbox:checked + .toggle-label:before {
    transform: translateX(1.75rem);
}
</style>
