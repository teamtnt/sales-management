import './bootstrap';

// jQuery
import $ from 'jquery';

window.jQuery = window.$ = $

// Vue 3
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import {createI18n} from 'vue-i18n'
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
import WorkFlow from './components/Workflow/WorkFlow.vue';
import ShowWorkFlow from './components/Workflow/ShowWorkFlow.vue';
import PipelineStageRepeater from "./components/PipelineStageRepeater/PipelineStageRepeater.vue";
import TextArea from "./components/TextareaWithPlaceholders/TextArea.vue";
import MultiSelectList from "./components/MultiSelectList/MultiSelectList.vue";
import Notes from "./components/Notes/Notes.vue";
import Activities from "./components/Notes/Activities.vue";
import OpenClicksChart from "./components/Dashboard/OpenClicksChart.vue";
import LeadDetails from "./components/LeadDetails/LeadDetails.vue";


const emitter = mitt();
const app = createApp({
    components: {
        WorkFlow,
        ShowWorkFlow,
        PipelineStageRepeater,
        TextArea,
        MultiSelectList,
        Notes,
        Activities,
        OpenClicksChart,
        LeadDetails
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
import './modules/notyf';
import './modules/dragula';

