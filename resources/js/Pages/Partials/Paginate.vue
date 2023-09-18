<template>
    <div>
        <ul class="flex justify-center space-x-4">
            <li v-for="link in links" :key="link.url">
                <Link v-if="link.url" :href="link.url" class="text-blue-900 p-2" :class="{'font-bold' : link.active}" v-html="link.label"></Link>
            </li>
        </ul>
    </div>
</template>

<script setup>

const props = defineProps({
    links: Array,
});

</script>