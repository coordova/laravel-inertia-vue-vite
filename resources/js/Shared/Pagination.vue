<template>
    <div>
        <Component
            v-for="link in links"
            :is="link.url ? 'Link' : 'span'"
            :href="link.url"
            v-html="link.label"
            class="px-1"
            :class="{ 'text-gray-500': ! link.url, 'font-bold' : link.active }"
        />
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: Array
    }
}
</script>

<style scoped>

</style>
