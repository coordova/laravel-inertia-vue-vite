<template>
    <h1>Hola, {{ name }}</h1>
    <ul>
        <li v-for="framework in frameworks">{{ framework }}</li>
    </ul>
</template>

<script>
export default {
    props: {
        name: String,
        frameworks: Array,
    },
};
</script>
