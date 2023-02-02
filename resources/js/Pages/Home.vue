<template>
    <Layout>
        <Head>
            <title>Home</title>
            <meta type="description" content="Home information" head-key="description">
        </Head>
        <h1 class="text-3xl">Blog</h1>

        <pre>
            <code>
                class Example
                {
                    public function __constructor()
                    {
                        //
                    }
                }
            </code>
        </pre>
        <br>
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
        </div>
    </Layout>
</template>

<script>
/*import hljs from "highlight.js/lib/common";
import javascript from "highlight.js/lib/languages/javascript";
import php from "highlight.js/lib/languages/php";
import html from "highlight.js/lib/languages/xml";
import yaml from "highlight.js/lib/languages/yaml";

import "highlight.js/styles/github-dark.css";

hljs.registerLanguage("php", php);
hljs.registerLanguage("javascript", javascript);
hljs.registerLanguage("html", html);
hljs.registerLanguage("yaml", yaml);*/

import {highlight, highlightElement} from "@/Services/SyntaxHighlighting";

export default {
    mounted() {
        // highlight('#example2');
        highlightElement(this.$refs.code);
    }
}
</script>
