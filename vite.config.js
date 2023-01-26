import { defineConfig, splitVendorChunkPlugin } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'

export default defineConfig({
    build: {
        outDir: "public/sales-management",
    },
    plugins: [
        splitVendorChunkPlugin(),
        laravel({
            publicDirectory: "public",
            buildDirectory: "sales-management", // ako ovog nema, onda na npm run build woff2 fajlovi od fontawsomea gledaju u krivi dir
            hotFile: "public/sales-management/hot",
            input: ['src/resources/scss/light.scss', 'src/resources/js/app.js',],
            refresh: true
    }), vue({
        template: {
            transformAssetUrls: {
                base: null, includeAbsolute: false,
            },
        },
    }), VueI18nPlugin({ /* options */}),], resolve: {
        alias: {
            // '@': '/src/resources/js'
            '~bootstrap': 'bootstrap',
            '~@fortawesome': '@fortawesome',
            '~simplebar': 'simplebar',
            '~notyf': 'notyf'
        }
    }
});
