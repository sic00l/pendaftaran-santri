import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/validation.js',
                'resources/js/ajax-check.js',
                'resources/js/image-preview.js',
                'resources/js/multi-step-form.js',
                'resources/js/admin-datatable.js',
                'resources/js/loading-states.js'
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
