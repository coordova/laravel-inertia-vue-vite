<template>
    <pre><code ref="block">{{ code }}</code></pre>
</template>


<script setup>
/*---------------------------------------------*/
// Composition API
/*---------------------------------------------*/
import {highlightElement} from "@/Services/SyntaxHighlighting";
import {onMounted, ref} from "vue";

defineProps({
    code: String
});

let block = ref(null);

onMounted(() => {
    highlightElement(block.value);
})

</script>

<script>
/*---------------------------------------------*/
// Option API
/*---------------------------------------------*/
/*import {highlightElement} from "@/Services/SyntaxHighlighting";

export default {
    props: {
        code: String
    },

    mounted() {
        // highlight('#example2');
        highlightElement(this.$refs.code);
    }
}*/
</script>





<style scoped>

</style>
