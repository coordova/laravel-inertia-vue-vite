<template>
    <Layout>
        <Head title="Users" />
        <div class="flex justify-between mb-6">
            <div class="flex items-baseline">
                <h1 class="text-3xl">Users</h1>
                <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3">New User</Link>
            </div>
            <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg">
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    <Link :href="`/users/${user.id}`">{{ user.name }}</Link>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm text-gray-900">
                                                    <a :href="`mailto:${user.email}`">{{ user.email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td v-if="user.can.edit" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                                        <!--<Link :href="`/users/${user.id}/delete`" method="post" class="text-red-500 hover:text-red-900" title="Delete" :data="{ foo: `${user.name}` }">x</Link>-->
                                        <Link :href="`/users/${user.id}/delete`" method="delete" as="button" type="button" :onBefore="() => window.confirm('Eliminar?')" class="text-red-500 hover:text-red-900" title="Delete">x</Link>
                                        <button @click="remove(user.id)" class="text-blue-500 hover:text-blue-900" >x</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Paginator-->
        <Pagination :links="users.meta.links" class="mt-6" />

        <!--<ul>
            <li v-for="user in users" :key="user.id" v-text="user.name"></li>
        </ul>-->
    </Layout>

    <!--<div style="margin-top: 400px">
        <p>The current time is {{ time }}.</p>

        <Link
            href="/users"
            class="text-blue-500"
            preserve-scroll
        >
            Refresh
        </Link>
    </div>-->
</template>

<script setup>
import Pagination from "@/Shared/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {debounce} from "lodash";

let props = defineProps({
    users: Object,
    filters: Object,
    can: Object // para fines de usar Authorization
});

// persistencia de la var search de la uri, del servidor al cliente, este valor se ha definido en la ruta 'users' en routes de web.php
let search = ref(props.filters.search);

// Dale un vistazo al valor de la variable 'search' e imprime en consola si hay un cambio
/*watch(search, value => {
    // console.log('changed ' + value);
    Inertia.get('/users', { search: value }, {
        preserveState: true,
        replace: true   // para evitar que cada letra q se escribe en 'search' field no sea una llamada XHR ajax
    })
});*/

// usando throttling/debounce de lodash para que hacer 1 solo request dependiendo si usamos throttling o debounce en un tiempo de milisegundos.
watch(search, debounce(function (value) {
    console.log('triggered : ' + valuec);

    Inertia.get('/users', { search: value }, {preserveState: true, replace: true});
}, 300));


let remove = (id) => {
    // alert('mmmm')
    if (confirm('Are you sure?')) {
        console.log(id);
        Inertia.visit(`/users/${id}/delete`, {method: 'post'})
    }
}
</script>
