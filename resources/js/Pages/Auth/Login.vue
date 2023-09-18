<template>
    <div>
        <Navbar />
        <div class="bg-gray-200 flex justify-center items-center h-screen">
            <div class="bg-white p-8 rounded-lg shadow-md w-[450px]">
                <h2 class="text-2xl font-semibold mb-4">Login</h2>
                <form @submit.prevent="form.post('/login')">
                    <div class="mb-4">
                        <label for="email" class="block text-gray-600">Email</label>
                        <input type="email" v-model="form.email" id="email" name="email"
                            class="w-full p-2 border border-gray-300 rounded">
                        <div v-if="form.errors.email" class="text-red-900">{{ form.errors.email }}</div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-600">Password</label>
                        <input type="password" v-model="form.password" id="password" name="password"
                            class="w-full p-2 border border-gray-300 rounded">
                        <div v-if="form.errors.password" class="text-red-900">{{ form.errors.password }}</div>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 rounded w-full">Login</button>
                </form>

                <div class="text-center mt-4">
                    <Link href="/forgot-password" class="text-blue-900 font-medium">Forgot your password?</Link>
                </div>

            </div>



        </div>


    </div>
</template>

<script setup>

import Navbar from '@/Pages/Partials/Navbar.vue'
import { useForm, router } from '@inertiajs/vue3'

let form = useForm({
    email: null,
    password: null
});

</script>