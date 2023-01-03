<template>
    <layout>
        <Head title="Create User" />

        <h1 class="text-3xl">Create New User</h1>

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
    </layout>
</template>

<script setup>

// import {reactive} from "vue";
// import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
// import {ref} from "vue";

/*defineProps({
    errors: Object,     // DEFINIMOS ESTO AQUI, LO QUE ES EQUIVALENTE A: $page.props.errors.[name|email|password]
})*/

// crear el form data - aqui usamos el componente que ofrece Inertia para formularios
let form = useForm({
    name: '',
    email: '',
    password: ''
});


/*let form = reactive({
    name: '',
    email: '',
    password: ''
});*/

// Metodo para crear el registro usando las bondades de 'useForm' de Inertia
let submit = () => {
    form.post('/users');
};

// crear el metodo submit con inertia, esto de la forma basica, sin usar 'useForm' de inertia
/*let processing = ref(false);
let submit = () => {
    Inertia.post('/users', form, {
        onStart: () => { processing.value = true },
        onFinish: () => { processing.value = false }
    });
};*/

</script>

<style scoped>

</style>
