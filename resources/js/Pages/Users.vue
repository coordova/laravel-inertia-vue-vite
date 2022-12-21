<template>
    <Layout>
        <h1 class="text-3xl">Users</h1>
    </Layout>

    <div style="margin-top: 400px">
        <p>The current time is {{ time }}.</p>

        <Link href="/users" class="text-blue-500" preserve-scroll>
            Refresh
        </link>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import Layout from "../Shared/Layout.vue";

defineProps({
    time: String
})
</script>
