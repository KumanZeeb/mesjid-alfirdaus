import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: true, // Aktifkan HTTPS
        host: '81b2-114-122-104-185.ngrok-free.app', // Sesuaikan dengan host Ngrok
    },
});