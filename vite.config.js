import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    base: '/simrs/public/assets/build/',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/sign.css', 'resources/js/sign.js'],
            refresh: true,
            buildDirectory: 'assets/build',
        }),
        tailwindcss(),
    ],
});
