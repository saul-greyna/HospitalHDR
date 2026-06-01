import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/menu.js',
                'resources/js/home.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
        vue()
    ],
    build: {
        modulePreload: false,
        cssCodeSplit: true,
        manifest: 'manifest.json',
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        watch: {
            usePolling: true,
            interval: 1000
        },
        hmr: {
            host: 'localhost'
        }
    }
});
