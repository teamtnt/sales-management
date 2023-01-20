import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler';
import {createI18n} from 'vue-i18n'
import translations from '../lang/de.json';

const messages = {
    de: translations,
}

const i18n = createI18n({
    locale: 'de',
    fallbackLocale: 'en',
    messages
})

i18n.global.locale = document.documentElement.lang.substr(0, 2);

const app = createApp({})


import eventBus from './eventBus';
import './axios';
import './custom';

window.EventBus = eventBus;

import helloWorld from './components/HelloWorld.vue';
import propertyForm from './components/Property/PropertyForm.vue';
import publishingPortals from './components/Property/PublishingPortals.vue';
import anchorNavigation from './components/General/AnchorNavigation.vue';
import anchorSection from './components/General/AnchorSection.vue';
import contactCreateEditModal from './components/Modals/ContactCreateEditModal.vue';
import confirmModal from './components/Modals/ConfirmModal.vue';

app.component('hello-world', helloWorld);
app.component('anchor-navigation', anchorNavigation);
app.component('anchor-section', anchorSection);
app.component('property-form', propertyForm);
app.component('publishing-portals', publishingPortals);
app.component('contact-create-edit-modal', contactCreateEditModal);
app.component('confirm-modal', confirmModal);

app.use(i18n)

app.mount('#app')

