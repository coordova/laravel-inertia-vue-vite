<template>
    <layout>
        <h1 class="text-3xl">{{ user.name }}</h1>
        <hr class="my-3">
        <ul class="space-y-2">
            <li>Email: {{ user.email }}</li>
            <li>Created At: {{ user.created_at }}</li>
            <li>{{ user }}</li>
        </ul>
    </layout>
</template>

<script setup>
import Layout from "@/Shared/Layout.vue";

defineProps({
    'user': Object
});

/*export default {
    name: "Show",
    components: {Layout}
}*/
</script>

<style scoped>

</style>
