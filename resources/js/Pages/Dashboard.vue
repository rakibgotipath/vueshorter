<template>
    <div>
        <Navbar />
        <div class="container mx-auto my-5">

            <div class="flex justify-center my-5">
                <img class="rounded-full" :src="auth.user.image" width="100" height="100" />
            </div>
            
            <h1 class="text-center text-2xl font-bold py-3 my-3">Hi, {{ auth.user?.name }}</h1>

            <div class="my-20 w-9/12 mx-auto">
                <div class="grid grid-cols-2 gap-5">
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">{{ widget.total_urls }}</h1>
                        <p>Total Url</p>
                    </div>
                    <div class="p-6 text-center">
                        <h1 class="text-2xl font-bold">{{ widget.total_views }}</h1>
                        <p>Total Views</p>
                    </div>
                </div>
            </div>


            <div class="w-9/12 mx-auto mt-3">
                <h3 class="text-xl font-bold mb-3">Your Shorten Urls</h3>
                <table class="min-w-full divide-y divide-gray-200 border border-sky-100">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Url
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Shorten Url
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Views
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Create At
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="url in urls.data" :key="url.id">
                            <td class="px-6 py-4 whitespace-nowrap text-ellipsis">
                                <a :href="url.click_url" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{
                                    url.url }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ url.click_url }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ url.views }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ url.created_at }}
                            </td>
                        </tr>
                        <!-- More table rows go here -->
                    </tbody>
                </table>

                <div class="my-3" v-if="urls.total > 10">
                    <Paginate :links="urls.links" />
                </div>

            </div>

        </div>

        <div class="py-4 text-center text-gray-600">
            &copy; 2023 All rights reserved.
        </div>

    </div>
</template>

<script setup>
import Navbar from './Partials/Navbar.vue';

defineProps({
    auth: Object,
    urls: Object,
    widget: Object,
});

</script>