<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CardRaw from '@/Components/Card-raw.vue';

defineProps({
    user: Object,
    treinos: Object,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Treinos of {{ user.name }}</h2>
        </template>

        <section class="grid max-w-6xl gap-3 mx-auto mt-10 place-items-center lg:grid lg:grid-cols-3 lg:gap-5 md:grid-cols-2 md:gap-3 md:grid">
            <div v-for="treino in user.treinos" :key="treino.id">
                    <CardRaw  :title='treino.name'> 
                      <span class="px-5 py-3 text-xs text-gray-400">{{ treino.dia }}</span>
                        <div class="px-5 py-3" v-for="exercicio in treino.exercicios ">
                            <div class="mb-5 treino">
                                <h1 class="mb-2 font-semibold text-gray-700 text-md "> {{ exercicio.name }}: </h1>
                                <p class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-500"> Series: {{ exercicio.series }} </p>
                                <p class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-500"> repeticoes: {{ exercicio.repeticoes }} </p>
                                <p class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-500"> descanso: {{ exercicio.descanso }} </p>
                            </div>
                        </div>  
                    </CardRaw>
            </div>
        </section>
    </AuthenticatedLayout>  
</template>
