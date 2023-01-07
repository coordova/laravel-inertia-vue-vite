<template>
    <Layout>
        <Head title="Edit User" />

        <h1 class="text-3xl">Edit User <span class="text-sm">{{ form.name }}</span></h1>

        <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
            <div class="mb-6">
                <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name</label>
                <input v-model="form.name" type="text" name="name" id="name" required class="border border-gray-400 p-2 w-full">
                <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                <input v-model="form.email" type="text" name="email" id="email" required class="border border-gray-400 p-2 w-full">
                <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                <input v-model="form.password" type="password" name="password" id="password" class="border border-gray-400 p-2 w-full">
                <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Submit</button>
            </div>
        </form>
    </Layout>
</template>

<script setup>
import Layout from "@/Shared/Layout.vue";
import {useForm} from "@inertiajs/inertia-vue3";

let props = defineProps({
    user: Object
    /*users: Object,
    filters: Object,
    can: Object // para fines de usar Authorization*/
});



console.log(props.user.name);

let form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: props.user.password
});

// Metodo para guardar el registro usando las bondades de 'useForm' de Inertia
let submit = () => {
    // console.log(`Formulario enviado: ${form.name} ${form.email}`);
    form.put(`/users/${props.user.id}` );
};

/*export default {
    name: "Edit",
    components: {Layout}
}*/
</script>

<style scoped>

</style>
