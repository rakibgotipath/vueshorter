<template>
    <div>
        <Navbar />
        <div class="flex justify-center items-center mt-10">
            <div class="bg-white p-8 rounded-lg shadow-md w-[450px]">
                <h2 class="text-2xl font-semibold mb-4">Forgot Password</h2>
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="password" class="block text-gray-600">Password</label>
                        <input type="password" v-model="form.password" id="password" name="password"
                            class="w-full p-2 border border-gray-300 rounded">
                        <div v-if="form.errors.password" class="text-red-900">{{ form.errors.password }}</div>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-600">Confirm Password</label>
                        <input type="password" v-model="form.password_confirmation" id="password_confirmation" name="password_confirmation"
                            class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <input type="hidden" name="token" v-model="form.token">
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

let props = defineProps({
    token: String,
});

let form = useForm({
    password: null,
    password_confirmation: null,
    token : props.token,
});

function submit(){
    form.post('/reset-password', {
        onSuccess: () => form.reset(),
    })
}

</script>