<template>
    <layout>
        <Head title="Create User" />

        <h1 class="text-3xl">Create New User</h1>

        <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
            <div class="mb-6">
                <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name</label>
                <input v-model="form.name" type="text" name="name" id="name" required class="border border-gray-400 p-2 w-full">
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                <input v-model="form.email" type="text" name="email" id="email" required class="border border-gray-400 p-2 w-full">
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                <input v-model="form.password" type="password" name="password" id="password" required class="border border-gray-400 p-2 w-full">
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Submit</button>
            </div>
        </form>
    </layout>
</template>

<script setup>

import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

// crear el form data
let form = reactive({
    name: '',
    email: '',
    password: ''
});

// crear el metodo submit con inertia
let submit = () => {
    Inertia.post('/users', form);
};

</script>

<style scoped>

</style>
