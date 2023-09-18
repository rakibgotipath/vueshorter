<template>
    <div>
        <Navbar />
        <div class="container mx-auto">
            <h1 class="text-center text-2xl font-bold py-3 my-3">Update Profile</h1>

            <div class="w-5/12 mx-auto mt-3">

                <div class="flex justify-center my-5">
                    <img class="rounded-full" :src="auth.user.image" width="100" height="100" />
                </div>

                <form @submit.prevent="submit">

                    <div class="mb-4">
                        <label for="name">Name</label>
                        <input type="text" v-model="form.name" class="w-full p-2 border border-gray-300 rounded">
                        <div v-if="form.errors.name" class="text-red-900">{{ form.errors.name }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="email">Email</label>
                        <input type="email" v-model="form.email" class="w-full p-2 border border-gray-300 rounded">
                        <div v-if="form.errors.email" class="text-red-900">{{ form.errors.email }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="password">Password</label>
                        <input type="password" v-model="form.password" class="w-full p-2 border border-gray-300 rounded">
                        <div v-if="form.errors.password" class="text-red-900">{{ form.errors.password }}</div>
                    </div>

                    <div class="mb-4">
                        <input type="file"  @input="form.image = $event.target.files[0]" />
                        <div v-if="form.errors.image" class="text-red-900">{{ form.errors.image }}</div>
                    </div>                    

                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update</button>

                </form>
                 
            </div>

        </div>

    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Navbar from './Partials/Navbar.vue';

const props = defineProps({
    auth: Object,
});

let form = useForm({
    name: props.auth.user.name,
    email: props.auth.user.email,
    password: '',
    image: '',
});

function submit(){
    form.post('/settings', {
        onSuccess: () => {
            form.reset();
        }
    });
}

</script>