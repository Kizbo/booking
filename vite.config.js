import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    build: {
        outDir: "../public/js", // Output directory for compiled JavaScript
        assetsDir: "../public/js", // Assets directory for JavaScript
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    postcss: {
        plugins: [postcssNesting],
    },
});
