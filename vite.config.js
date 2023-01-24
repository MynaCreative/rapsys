import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        manifest: true,
        minify: 'terser',
        chunkSizeWarningLimit: 1500,
        target: ['es2020', 'safari14'],
    },
    optimizeDeps: {
        esbuildOptions: {
            target: ['es2020', 'safari14'],
        }
    }
});
