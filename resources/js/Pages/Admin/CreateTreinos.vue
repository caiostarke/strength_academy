<template>
    <Head title="Create Treinos" />
    
    <AuthenticatedLayout :isAdmin="user.role === 'admin'">
        <template #header>
            <div class="flex items-center">
                <h2 class="mr-2 text-xl font-semibold leading-tight text-gray-800">Kaer</h2>
                <span class="px-2 py-1 text-xs bg-yellow-100 rounded"> Admin </span>
            </div>

        </template>
        
        <main class="max-w-6xl px-5 py-8 mx-auto sm:px-2">
            <span class="text-sm text-gray-500">User id: {{ id }}</span>
            <h1 class="mt-3 text-lg font-bold text-gray-800">User name: {{ targetUser.name }}</h1>
            
            <div class="mt-5" v-if="Object.keys(targetUser.treinos).length === 0">
                <h1 class="mb-3"> Not treinos yet</h1>
                
            </div>

            <div v-else  class="grid gap-3 mx-auto mt-10 place-items-center lg:grid lg:grid-cols-3 lg:gap-10 md:grid-cols-2 md:gap-3 md:grid">
                <div v-for="treino in targetUser.treinos" :key="treino.id">
                    <CardRaw  :title="treino.name" class=""> 
                        <div class="px-5 py-3 mb-5"> 
                            <span class="text-xs text-gray-400 ">{{ treino.dia }}</span>
                            <div v-for="exercicio in treino.exercicios" class="mt-5 treino">
                                <h1 class="font-semibold text-gray-700"> {{  exercicio.name }}</h1>
                                <p class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-500"> Series: {{exercicio.series}} </p>
                                <p class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-500"> repeticoes: {{exercicio.repeticoes}} </p>
                                <p class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-500"> descanso: {{ exercicio.descanso }} </p>
                            </div>
                        </div>

                        <Link :href="'/admin/treino/' + treino.id" class="px-3 py-2 ml-4 text-sm text-white rounded bg-sky-600"> Add exercise to this Treino</Link>
                        <DangerButton
                            class="ms-3"
                            @click="deleteTreino(treino.id)"
                        >
                            Delete Treino
                        </DangerButton>

                    </CardRaw>
                </div>
            </div>

            <PrimaryButton @click="toggleForm" class="mt-5"> {{ isFormOpened ? 'Close Menu' : 'Create Treino'}} </PrimaryButton>

            <div v-if="isFormOpened" class="mt-5">
                <form @submit.prevent="submit">
                    <div class="flex flex-col w-fit">
                        <InputLabel for="name" value="Name" />

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
                        <InputLabel for="dia" value="Dia" />

                        <TextInput
                            id="dia"
                            type="text"
                            class="block w-full mt-1"
                            v-model="form.dia"
                            required
                            autofocus
                            autocomplete="dia"
                        />

                        <InputError class="mt-2" :message="form.errors.dia" />
                    </div>
                    
                    <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create
                    </PrimaryButton>
                </form>
            </div>


        </main>
    </AuthenticatedLayout>
</template>

<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<script setup>
    import CardRaw from '@/Components/Card-raw.vue';
    import { Head, useForm, Link, router } from '@inertiajs/vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputError from '@/Components/InputError.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';   
    import { ref } from 'vue';
    import DangerButton from '@/Components/DangerButton.vue';

    const isFormOpened = ref(false);

    const props = defineProps({
        id: String,
        targetUser: Object,
        treinos: Object,
        user: Object,
    })

    const form = useForm({
        name: '',
        dia: '',
    });

    const submit = () => {
        form.post(`/admin/user/${props.id}`,{
            preserveScroll:true,
        });
        form.reset()
    };


    function toggleForm() {
        isFormOpened.value = !isFormOpened.value
    }

    const deleteTreino = (treinoID) => {
        router.delete(`/admin/treino/${treinoID}`)
    }

</script>   