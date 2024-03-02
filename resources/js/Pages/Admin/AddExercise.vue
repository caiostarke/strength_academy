<template>

    <Head title="Admin - Add Exercises" />

    <main class="max-w-5xl px-5 py-16 mx-auto sm:px-2">
        <div class="flex items-center mb-12">
            <h2 class="mr-2 text-xl font-semibold leading-tight text-gray-800">{{ user.name }}</h2>
            <span class="px-2 py-1 text-xs bg-yellow-100 rounded" v-if="user.role == 'admin'"> Admin </span>
        </div>

        <h1> Treino: {{ treino.name }}</h1>
        <p> Dia: {{ treino.dia }}</p>
        <div class="flex">
            <p class="mr-2"> Exercicios nesse treino: </p>
            <span v-for="ex in exercicios" class="mr-2 text-yellow-700"> {{ ex.name }},</span>
        </div>

        <PrimaryButton @click="toggleForm" class="mt-5"> {{ isFormOpened ? 'Close Menu' : 'Create Exercise for Treino'}} </PrimaryButton>

        <div v-if="isFormOpened" class="mt-5">
            <form @submit.prevent="submit">
                <div class="flex flex-col w-fit">
                    <InputLabel for="name" value="Name of Exercise eg.(Leg Press)" />

                    <TextInput
                        id="name"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="flex flex-col mt-3 w-fit">
                    <InputLabel for="repeticoes" value="Repeticoes" />

                    <TextInput
                        id="repeticoes"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.repeticoes"
                        required
                        autofocus
                        autocomplete="repeticoes"
                    />

                    <InputError class="mt-2" :message="form.errors.repeticoes" />
                </div>


                <div class="flex flex-col mt-3 w-fit">
                    <InputLabel for="descanso" value="Descanso" />

                    <TextInput
                        id="descanso"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.descanso"
                        required
                        autofocus
                        autocomplete="descanso"
                    />

                    <InputError class="mt-2" :message="form.errors.descanso" />
                </div>



                <div class="flex flex-col mt-3 w-fit">
                    <InputLabel for="series" value="Series" />

                    <TextInput
                        id="series"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.series"
                        required
                        autofocus
                        autocomplete="series"
                    />

                    <InputError class="mt-2" :message="form.errors.series" />
                </div>

                
                <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create
                </PrimaryButton>
            </form>
        </div>

    </main>


</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  layout: AuthenticatedLayout,
}
</script>

<script setup>
    import { Head, useForm, Link, router } from '@inertiajs/vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputError from '@/Components/InputError.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';   

    import { ref } from 'vue'

    const isFormOpened = ref(false)

    const props = defineProps({
        treino: Object,
        user: Object,
        exercicios: Object,
    })

    const form = useForm({
        name: '',
        repeticoes: '',
        descanso: '',
        series: '',
    })

    function toggleForm() {
        isFormOpened.value = !isFormOpened.value
    }

    const submit = () => {
        form.post(`/admin/treino/${props.treino.id}`, {
            preserveScroll:true,
        })

        form.reset()
    }

</script>