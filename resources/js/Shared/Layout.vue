<template>
    <Head>
        <meta type="description" content="Information about my app" head-key="description">
    </Head>

    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center space-x-4">
                <h1 class="font-bold text-lg">My App</h1>
                <p>
                    Welcome Back, {{ username }}
                </p>
            </div>
            <Nav/>
        </header>
    </section>
    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <!--<iframe height="200px" width="100%" frameborder="no" scrolling="no" seamless src="https://player.simplecast.com/fd0bd2ba-c553-466c-a060-b144797ce369?dark=false"></iframe>-->
            <slot/>
        </div>
    </section>
</template>

<script>
import Nav from "./Nav.vue";

export default {
    name: "Layout",
    components: {Nav},

    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
}
</script>

<style scoped>

</style>
