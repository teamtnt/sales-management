import './bootstrap';

// jQuery
import $ from 'jquery';
window.jQuery = window.$ = $

// Vue 3
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createI18n } from 'vue-i18n'
import mitt from 'mitt';

// Translations
import translations from '../lang/de.json';

const messages = {
    de: translations,
}
const i18n = createI18n({
    locale: 'de',
    fallbackLocale: 'en',
    messages
})

i18n.global.locale = document.documentElement.lang.substring(0, 2);

// Components
import HelloWorld from './components/HelloWorld.vue';

const emitter = mitt();
const app = createApp({
    components: {
        HelloWorld
    }
})

app.config.globalProperties.emitter = emitter;
app.use(i18n);

if (document.querySelector("#app") !== null) {
    app.mount("#app");
}

// Datatables
import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-select-bs5';
window.DataTable = DataTable;

// Modules
import './modules/sidebar';
import './modules/feather';

