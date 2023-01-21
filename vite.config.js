import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'

export default defineConfig({
    plugins: [laravel({
        input: ['src/resources/scss/light.scss', 'src/resources/js/app.js',],
        buildDirectory: 'sales-management',
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
            '~simplebar': 'simplebar'
        }
    }
});
