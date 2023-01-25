<template>
    <layout>
        <h1 class="text-3xl">Usuario</h1>
        <hr>
        <ul>
            <li>Nombre: {{ user.name }}</li>
            <li>Nombre: {{ user.email }}</li>
        </ul>
        <hr>
        {{ user }}
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
