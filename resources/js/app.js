import { createApp, h } from "vue";
import {createInertiaApp, Link} from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { InertiaProgress } from "@inertiajs/progress";
import { reduce } from "lodash";
import Layout from "@/Shared/Layout.vue";

createInertiaApp({
    resolve: (name) => {
        /*resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/!**!/!*.vue")
        );*/
        /*-----------------------*/
        let page = require(`./Pages/${name}`).default;
        /*if (! page.layout) {
            page.layout = Layout;
        }*/
        page.layout ??= Layout;
        return page;
        /*-----------------------*/
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            // para registrar componentes de forma global, verificar sus imports arriba en la cabecera
            .component("Link", Link)
            .mount(el);
    },
});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: "magenta", // "#29d",

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
});
