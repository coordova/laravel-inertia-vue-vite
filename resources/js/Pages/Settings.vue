<template>
    <Layout>
        <h1 className="text-3xl">Settings</h1>
    </Layout>

    <!--<<h1 class="text-4xl">Users</h1>

    <Nav />-->
</template>

<script>
// import Nav from "../Shared/Nav.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Layout from "../Shared/Layout.vue";

export default {
    // components: { Nav, Link },
    components: {Layout},

    props: {
        time: String
    }
};
</script>
