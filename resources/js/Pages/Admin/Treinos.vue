<template>
    
    <Head title="Treinos "/>

    <AuthenticatedLayout :isAdmin="users.user.role === 'admin'">
    
    <main class="max-w-5xl px-5 py-16 mx-auto sm:px-2">
        <div class="flex items-center mb-12">
            <h2 class="mr-2 text-xl font-semibold leading-tight text-gray-800">{{ users.user.name }}</h2>
            <span class="px-2 py-1 text-xs bg-yellow-100 rounded" v-if="users.user.role == 'admin'"> Admin </span>
        </div>

    <section class="users">
        <input type="text" name="input" id="input" placeholder="search user" v-model="input" class="mb-8 rounded-md">
        <div v-for="user in users.users.data"  class="">
            <div  class="flex justify-between px-5 py-3 mb-3 shadow-lg bg-slate-150">
                
                <h1> {{  user.name }}</h1>
                <Link :href="'/admin/user/' + user.id"> Add Train Exercises </Link>
            </div>
        </div>
    </section>

    <!-- Pagination  -->
     <div>   
        
        <Component
        v-for="link in users.users.links"
        :is="link.url ? Link : 'span'"
        :href="link.url"
        v-html="link.label"
        class="px-1 "
        :class="{ 'text-gray-500' : !link.url, 'font-bold' : link.active}"
        />

    </div>
    

    </main>
</AuthenticatedLayout >

</template>


<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import { ref,watch  } from 'vue';

let props = defineProps({
    users: Object,
    user: Object,
})

const input = ref(props.users.filters.search);

watch(input, value => {
    console.log(value);
    router.get('/admin/users', { search: value}, {
        preserveState: true,
        replace: true,
    })
})

</script>   

