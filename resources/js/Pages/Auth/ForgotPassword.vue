<template>
    <div>
        <Navbar />
        <div class="flex justify-center items-center mt-10">
            <div class="bg-white p-8 rounded-lg shadow-md w-[450px]">
                <h2 class="text-2xl font-semibold mb-4">Forgot Password</h2>
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="email" class="block text-gray-600">Email</label>
                        <input type="email" v-model="form.email" id="email" name="email"
                            class="w-full p-2 border border-gray-300 rounded">
                        <div v-if="form.errors.email" class="text-red-900">{{ form.errors.email }}</div>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 rounded w-full">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

import Navbar from '@/Pages/Partials/Navbar.vue'
import { useForm, router } from '@inertiajs/vue3'

let form = useForm({
    email: null,
});

function submit(){
    form.post('/forgot-password', {
        onSuccess: () => form.reset(),
    })
}

</script>