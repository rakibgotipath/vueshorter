import { createApp, h } from "vue";
import { Head, Link, createInertiaApp } from "@inertiajs/vue3";
import Paginate from "@/Pages/Partials/Paginate.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
            title: (title) => `${title} - My App`,
        })
            .component("Link", Link)
            .component("Head", Head)
            .component("Paginate", Paginate)
            .use(plugin)
            .mount(el);
    },
	title: (title) => title ? `${title} - Laravel` : 'Laravel',
});
