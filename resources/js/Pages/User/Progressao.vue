<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';   
import PrimaryButton from '@/Components/PrimaryButton.vue';


import { ref } from 'vue';

defineProps({
    user: Object,
})

const isMenuOpened = ref(false);

const toggleMenu = () => {
    isMenuOpened.value = !isMenuOpened.value
}

const form = useForm({
    progressaoRecordID: '',
    exerciseName: '',
    weight: '',
})


const openMenu = (exerciseName, prID) => {
    isMenuOpened.value = !isMenuOpened.value
    console.log(prID);
    form.exerciseName = exerciseName;
    form.progressaoRecordID = prID;
}


const submitProgression = () => {
    form.post('/progressao', {
        preserveScroll: true,
    })

    form.reset()
}

</script>

<template>
    <Head title="Progressao de Carga" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Progressao of {{ user.name }}</h2>
        </template>

        <main class="max-w-6xl px-5 py-5 mx-auto">

        <section class="mt-5 ">
            <h1 class="text-xl font-semibold text-gray-700"> List of Progressions</h1>
            <div class="grid gap-3 mt-5 sm:grid sm:grid-cols-3 sm:gap-5 progression__list">
                <div v-for="pr in user.progressao_records" class="flex flex-col justify-between px-5 py-6 rounded-md shadow-2xl bg-slate-50">
                    <h1 class="text-lg font-medium text-gray-800">{{pr.exercise_name}}</h1>
                    <div v-for="progressao in pr.progressaos">
                        <div class="flex gap-3 mt-5">
                            <p class="text-gray-600">Day: {{ progressao.created_at.substring(0, 10) }}</p>
                            <p>Lifted Weight: {{ progressao.weight }}</p>
                        </div>
                    </div>
                    <div>
                        <PrimaryButton class="mt-7" @click="openMenu(pr.exercise_name, pr.id)"> Add More progressions</PrimaryButton>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-32">
            <div @click="toggleMenu" class="flex items-center gap-3 px-4 py-2 text-white transition duration-200 ease-in-out bg-blue-500 rounded cursor-pointer w-fit button hover:bg-blue-700" >
                <svg width="30px" height="30px" viewBox="0 0 24 24" class="fill-white" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z" fill="#FFFFF"/>
                </svg>
                <p> Add Progressao Record</p>
            </div>  
        </section>

        <section v-if="isMenuOpened" class="mt-10 progressao__menu">
            <form @submit.prevent="submitProgression">
                
                <div class="hidden">
                    <TextInput
                        id="progressaoRecordID"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.progressaoRecordID"
                    />
                </div>

                <div class="flex flex-col w-fit">
                    <InputLabel for="exerciseName" value="Name of the Exercise you are progressing" />

                    <TextInput
                        id="exerciseName"
                        type="text"
                        class="block w-full mt-1"
                        required
                        autofocus
                        autocomplete="name"
                        v-model="form.exerciseName"
                    />

                    <InputError class="mt-2" :message="form.errors.exerciseName"/>
                </div>

                <div class="flex flex-col mt-4 w-fit">
                    <InputLabel for="weight" value="Actual Weight" />

                    <TextInput
                        id="weight"
                        type="text"
                        class="block w-full mt-1"
                        required
                        autofocus
                        v-model="form.weight"
                        autocomplete="weight"
                    />

                    <InputError class="mt-2" :message="form.errors.weight" />
                </div>

                <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create
                </PrimaryButton>

            </form>
        </section>

        </main>

    </AuthenticatedLayout>  
</template>
