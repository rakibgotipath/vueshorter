<template>
    <div>

        <Head :title="$page.props?.pageTitle"></Head>
        <header class="border-b border-slate-200">
            <div class="flex justify-between container mx-auto py-3 items-center">
                <div class="font-bold">
                    <Link href="/" class="text-blue-900 uppercase">Logo</Link>
                </div>
                <div class="items-center space-x-4" v-if="$page.props.auth.user">

                    <Menu as="div" class="relative inline-block text-left">
                        <MenuButton class="font-medium">
                            <img :src="$page.props.auth.user.image" class="w-[28px] h-[28px] mt-1 rounded-full">
                        </MenuButton>
                        <MenuItems
                            class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <MenuItem>
                            <Link href="/dashboard" class="text-blue-900 font-medium block py-3 px-4">Dashboard</Link>
                            </MenuItem>
                            <MenuItem>
                            <Link href="/settings" class="text-blue-900 font-medium block py-3 px-4">Settings</Link>
                            </MenuItem>
                            <MenuItem>
                            <Link href="/logout" method="post" as="button"
                                class="text-blue-900 font-medium block py-3 px-4">Logout</Link>
                            </MenuItem>
                        </MenuItems>
                    </Menu>
                </div>
                <div class="items-center space-x-4" v-else>

                    <Menu as="div" class="relative inline-block text-left">
                        <MenuButton class="font-medium">
                            <img :src="computedImageSrc" class="w-[28px] h-[28px] mt-1">
                        </MenuButton>
                        <MenuItems
                            class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <MenuItem>
                            <Link href="/login" class="text-blue-900 font-medium block py-3 px-4">Login</Link>
                            </MenuItem>
                            <MenuItem>
                            <Link href="/register" class="text-blue-900 font-medium block py-3 px-4">Register</Link>
                            </MenuItem>
                        </MenuItems>
                    </Menu>

                </div>

            </div>
        </header>

        <div v-if="$page.props.flash.success"
            class="shadow bg-blue-100 border-l-4 border-blue-500 p-4 py-3 flex justify-between items-center w-4/12 mx-auto mt-3 rounded">
            <span>{{ $page.props.flash.success.message }}</span>
            <span class="p-1 cursor-pointer font-bold text-xl" @click="$page.props.flash.success = null">&times;</span>
        </div>

        <div v-if="$page.props.flash.error"
            class="bg-yellow-100 border-l-4 border-yellow-500 p-4 py-3 flex justify-between items-center w-4/12 mx-auto mt-3">
            <span>{{ $page.props.flash.error.message }}</span>
            <span class="p-1 cursor-pointer font-bold text-xl" @click="$page.props.flash.error = null">&times;</span>
        </div>

    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { defineProps, computed } from 'vue';
let props = defineProps({
    image: String,
});

const computedImageSrc = computed(() => {
    return props.image ? props.image : '/images/avatar.png';
});

</script>