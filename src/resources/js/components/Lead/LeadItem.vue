<script setup>
import { computed } from "vue";
import LeadDetails from "./LeadDetails.vue";

import User from "../SVG/User.vue";
import Mail from "../SVG/Mail.vue";
import Phone from "../SVG/Phone.vue";
import Tag from "../SVG/Tag.vue";

const props = defineProps({
    lead: {
        type: Object,
        required: true
    },
    campaign: {
        type: Object,
        required: true
    }
})

const nextCallActivityDate = computed(() => {
    const dateString = props.lead?.next_call_activity?.start_date;
    if (!dateString) return null;

    const date = new Date(dateString);

    const formatter = new Intl.DateTimeFormat('de-DE', {
        day: 'numeric',
        month: '2-digit',
        year: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
    });

    return formatter.format(date);
});

</script>

<template>
    <div class="lead-item card mb-3 p-2 bg-light border gap-1" :data-lead-id="lead.id">

    <!-- Drag Handle -->
    <span class="drag-handle"
          style="
        display: inline-block;
        width: 20px;
        cursor: grab;
        margin-bottom: 5px;
        color: #a7a7a7;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move align-middle" style="pointer-events: none;"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
    </span>

    <div class="d-flex align-items-center">
        <User class="flex-shrink-0"/>
        <span class="ms-2 lead-name">
<!--            href="{{ route('teamtnt.sales-management.contacts.edit', $lead->contact) }}"-->
            <a target="_blank" href="#">
                {{ lead.contact?.firstname }} {{ lead.contact?.lastname }}
            </a>
        </span>
    </div>
    <div class="d-flex align-items-center">
        <Mail />
        <span class="ms-2 lead-email">{{ lead.contact?.email }}</span>
    </div>
    <div class="d-flex align-items-center">
        <Phone />
        <span class="ms-2">{{ lead.contact?.phone}}</span>
    </div>
    <div v-if="lead.contact?.tags.length > 0 || lead?.tags.length > 0" class="d-flex align-items-center">
        <Tag class="me-2 flex-shrink-0" />
        <ul class="list-unstyled d-flex flex-wrap m-0" style="gap: 2px 3px;">
            <li v-for="tag in lead.contact.tags" :key="tag.id" class="badge rounded-pill bg-info fw-light">{{ tag.name }}</li>
            <li v-for="tag in lead.tags" :key="tag.id" class="badge rounded-pill bg-info fw-light">{{ tag.name }}</li>
        </ul>
    </div>
    <div v-if="lead.next_call_activity" class="d-flex align-items-center">
        <Phone />
        <span class="ms-2">
            {{ nextCallActivityDate }}
        </span>
    </div>

<!--For details-->
<!-- :routes="{{ $routes->toJson() }}"-->
<!--        :emails="{{ json_encode(config('sales-management.emails')) }}"-->
<!--        :key="{{ $lead->id }}"-->
    <LeadDetails />
</div>
</template>

<style scoped>

</style>
