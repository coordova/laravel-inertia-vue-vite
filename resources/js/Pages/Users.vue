<template>
    <Head title="Users" />
    <!--<Head>
        <title>Users</title>
        <meta type="description" content="Users information" head-key="description">
    </Head>-->
    <Layout>
        <h1 class="text-3xl">Users</h1>
    </Layout>

    <div style="margin-top: 400px">
        <p>The current time is {{ time }}.</p>

        <Link
            href="/users"
            class="text-blue-500"
            preserve-scroll
        >
            Refresh
        </Link>
    </div>
</template>

<script setup>
// import Layout from "../Shared/Layout.vue";

defineProps({time: String})
</script>
