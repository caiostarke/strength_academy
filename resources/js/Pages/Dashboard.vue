<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { Head } from '@inertiajs/vue3';
import Plans  from '@/Pages/User/Plans.vue';


defineProps({
    user: Object,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :isAdmin="user.user.role === 'admin'">
        <template #header>
            <div class="flex items-center" v-if="user.user.role == 'admin'">
                <h2 class="mr-2 text-xl font-semibold leading-tight text-gray-800">{{ user.user.name }}</h2>
                <span class="px-2 py-1 text-xs bg-yellow-100 rounded"> Admin </span>
            </div>

            <h2 v-else class="text-xl font-semibold leading-tight text-gray-800">Dashboard of {{ user.user.name }}</h2>
        </template>

        <section class="max-w-6xl px-5 mx-auto mt-10">

            <Plans :plan="user.plan"/>
        
        </section>
    </AuthenticatedLayout>  
</template>
