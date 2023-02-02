<template>
    <Layout>
        <Head>
            <title>Home</title>
            <meta type="description" content="Home information" head-key="description">
        </Head>
        <h1 class="text-3xl">Blog</h1>

        <Highlight :code="snippet" />
        <!--
        <div id="example2">
            <pre>
                    <code ref="code">
                        class ExampleAgain
                        {
                            public function __constructor()
                            {
                                //
                            }
                        }
                    </code>
                </pre>
        </div>-->
    </Layout>
</template>

<script setup>
import Highlight from "@/Components/Highlight.vue";

let snippet = `
class Example
{
    public function __constructor()
    {
        //
    }
}
`.trim();
</script>
