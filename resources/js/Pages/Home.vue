<template> 

    <Head title="Home " />

    <div class="flex flex-col w-3/4 mx-auto bg-green-200 align-center">
        <h1> Hello {{ name }}</h1>

        <p> We gonna use in this series the following frameworks.</p>

        <ul>
            <li v-for="framework of frameworks" v-text="framework"></li>
        </ul>

        <nav>
            <ul>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </nav>
    </div>



</template>

<script setup>
    import { Head } from '@inertiajs/vue3'

    defineProps({
        name: String,
        frameworks: Array,
    })
    
</script>   