<template>
    <div>
        <span
            @click="toggleOffCanvas"
            class="info-icon"
            aria-controls="offcanvasRight">
            <svg width="26" height="26" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="pointer-events: none;">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
            </svg>
        </span>

        <template v-if="showOffCanvas">
            <OffCanvas
                v-model="showOffCanvas"
                :lead="lead"
                :tags="tags"
                :lists="lists"
                :routes="routes"
            />
        </template>
    </div>
</template>

<script setup>
import { ref, provide, reactive } from "vue";
import OffCanvas from "./OffCanvas.vue";

const props = defineProps({
    routes: {
        type: Object,
        required: true
    },
    emails: {
        type: Object,
        required: true
    }
})

const showOffCanvas = ref(false);
const lead = ref(null);
const tags = ref([]);
const lists = ref([]);
const data = reactive({
    route: props.routes.messages.send,
    emails: props.emails
});

async function fetchLeadData() {
    try {
        const response = await axios.get(props.routes.leads.leadData);

        lead.value = response.data.lead;
        tags.value = JSON.parse(response.data.tags);
        lists.value = JSON.parse(response.data.lists);
    } catch (error) {
        console.error(error);
    }
}

const toggleOffCanvas = async () => {
    await fetchLeadData();
    showOffCanvas.value = true;
}

provide('data', data);
</script>

