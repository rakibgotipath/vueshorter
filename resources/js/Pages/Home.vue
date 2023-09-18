<template>
    <div>
        <Navbar />

        <div class="container mx-auto">

            <div class="text-center py-6 my-5">
                <h1 class="text-center text-2xl font-bold py-3">Welcome to, Laravel</h1>
                <p>Custom short links, powerful dashboard, detailed analytics, API, UTM builder, QR codes, browser
                    extension, app integrations and support</p>
            </div>

            <div v-if="$page.props.auth.user" class="w-6/12 mx-auto">

                <div class="">
                    <form @submit.prevent="form.post('/shorten', {
                        preserveScroll: true,
                        onSuccess: () => form.reset('url')
                    })">
                        <div class="flex justify-center items-center space-x-4">
                            <input type="text" v-model="form.url" id="url" name="url"
                                class="w-full p-2 border border-gray-300 rounded">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Shorten</button>
                        </div>
                        <div v-if="form.errors.url" class="text-red-900">{{ form.errors.url }}</div>
                    </form>
                </div>

            </div>

            <div v-else class="flex justify-center text-center space-x-4 items-center">

                <Link href="/register" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Create an Account</Link>
                <span class="text-gray-400">or</span>
                <Link href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login
                </Link>

            </div>

            <div class="my-20 w-9/12 mx-auto">
                <div class="grid grid-cols-3 gap-5">
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">Easy</h1>
                        <p>ShortURL is easy and fast, enter the long link to get your shortened link</p>
                    </div>
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">Shortened</h1>
                        <p>Use any link, no matter what size, ShortURL always shortens</p>
                    </div>
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">Secure</h1>
                        <p>It is fast and secure, our service has HTTPS protocol and data encryption</p>
                    </div>
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">Statistics</h1>
                        <p>Check the number of clicks that your shortened URL received</p>
                    </div>
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">Reliable</h1>
                        <p>All links that try to disseminate spam, viruses and malware are deleted</p>
                    </div>
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">Devices</h1>
                        <p>Compatible with smartphones, tablets and desktop</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script setup>
import Navbar from '@/Pages/Partials/Navbar.vue'

import { useForm } from '@inertiajs/vue3';

let form = useForm({
    url: null,
});

onError: (errors) => {
    window.Toast.error(errors.create)
}

</script>