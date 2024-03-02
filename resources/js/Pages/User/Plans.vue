<template>
    
    <div class="max-w-screen-md mx-auto mb-8 text-center lg:mb-12">
          <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900">Designed for business teams like yours</h2>
          <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">At <span class="text-orange-800"> Elite Strength Academy </span> we focus on user driven technology and innovation, meaning a high quality and experience for each user going beyond the basic to provide only a gym.</p>
    </div>

    <div class=" lg:grid lg:grid-cols-3 lg-gap-5 sm:gap-4">
        <Card v-for="x in plans"
            :name="x.name"
            :price="x.price"
            :benefits="x.benefits"
            :active='x.name.toLowerCase() == plan.toLowerCase()'
        />
    </div>


</template>

<script setup>
    import { ref } from 'vue'
    import Card from '@/Components/Card.vue'

    defineProps({
        plan: String,
    })

    const plans = ref([
        {name: 'Free', price: 'Free', benefits: ['U can allow your users registrate on your platform']},
        {name: 'Basic', price: '$49.99', benefits: ['U can allow your users registrate on your platform', 'You can define your own subdomain "YOURGYMNAMEHERE".elitestrength.academy', 'Yours instructors can pass trains to users directly on the plataform']},
        {name: 'Premium', price: '$89.99', benefits: ['U can allow your users registrate on your platform', 'You can define your own domain "YOURGYMNAMEHERE".academy', 'Yours instructors can pass trains to users directly on the plataform', 'Yours users can use diet managament features', 'Users can chat and use the social media of all integrated gyms', 'Automatic diet plan to users (feature)']},
    ])
    
</script>