import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js", "resources/js/booking-calendar.js"],
            refresh: true,
        }),
    ],
    postcss: {
        plugins: [postcssNesting],
    },
});
