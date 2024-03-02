<template>

<!-- Pricing Card -->
<div :class="classes">
    <h3 class="mb-4 text-2xl font-semibold">{{ name }}</h3>
    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best option for personal use & for your next project.</p>
    <div class="flex items-baseline justify-center my-8">
        <span class="mr-2 text-5xl font-extrabold">{{ price }}</span>
        <span class="text-gray-500 dark:text-gray-400">/month</span>
    </div>
    <!-- List -->
    <ul role="list" class="mb-8 space-y-4 text-left">
        <li class="flex items-center space-x-3 text-sm" v-for="benefit in benefits">
            <!-- Icon -->
            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            <span>{{ benefit }}</span>
        </li>

    </ul>
    <p class="text-white focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900" v-if="active">This one is already Your plan</p>
    <a href="#" class="text-white bg-gray-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900" v-else>Get started</a>
</div>

</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    name: String,
    active: Boolean,
    price: String,
    benefits: Array,
})

const classes = computed(() =>
    props.active
    ? 'border-2 border-blue-600 flex flex-col text-center text-gray-900 bg-white rounded-lg shadow  xl:p-8 dark:bg-gray-800 border-blue-200 dark:text-white '
    : 'flex flex-col text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white'

);

</script>

