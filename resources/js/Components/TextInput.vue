<script setup>
import { onMounted, ref, watch } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

watch(input, value => {
    console.log(value);
})
</script>

<template>
    <input
        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        v-model="model"
        ref="input"
    />
</template>
