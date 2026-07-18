import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/navbar-dropdown.css',
                'resources/css/facilities-and-services.css',
                'resources/css/ruang-perawatan.css',
                'resources/js/app.js',
                'resources/js/navbar/navbar.js',
                'resources/js/navbar/navbar-dropdown.js',
                'resources/js/promotions/promotions.js',
                'resources/js/facilities-and-services/facilities.js',
                'resources/js/ruang-perawatan/ruang-perawatan.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
