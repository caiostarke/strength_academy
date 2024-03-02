<template>

    <div class="pb-8 text-black rounded shadow-xl min-w-96 w-fit bg-slate-50">
        <h1 class="px-4 py-4 text-lg font-bold text-gray-800" > {{ title }} </h1>
        <hr class="mb-1">
        <slot />        
    </div>

</template>

<script setup>

const props = defineProps({
    title: String,    
})


</script>

