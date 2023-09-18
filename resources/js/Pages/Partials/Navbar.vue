<template>
    <div>

        <Head :title="$page.props?.pageTitle"></Head>
        <header class="border-b border-slate-200">
            <div class="flex justify-between container mx-auto py-4">
                <div class="font-bold">
                    <Link href="/" class="text-blue-900 uppercase">Logo</Link>
                </div>
                <div class="items-center space-x-4" v-if="$page.props.auth.user">
                    <Link href="/dashboard" class="text-blue-900 font-medium">Dashboard</Link>
                    <Link href="/settings" class="text-blue-900 font-medium">Settings</Link>
                    <Link href="/logout" method="post" as="button" class="text-blue-900 font-medium">Logout</Link>
                </div>
                <div class="items-center space-x-4" v-else>
                    <Link href="/login" class="text-blue-900 font-medium">Login</Link>
                    <Link href="/register" class="text-blue-900 font-medium">Register</Link>
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

</script>