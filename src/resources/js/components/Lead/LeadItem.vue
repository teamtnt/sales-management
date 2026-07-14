<script setup>
import { computed } from "vue";
import LeadDetails from "./LeadDetails.vue";
import { inject } from "vue";

//SVG Icons
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
    },
    stage: {
        type: Object,
        required: false,
        default: () => ({})
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

const leadCreatedDate = computed(() => {
    const dateString = props.lead?.created_at;

    console.log('Lead data:', props.lead); // Debug log
    console.log('Created at:', dateString); // Debug log

    if (!dateString) return null;

    const date = new Date(dateString);
    const formatter = new Intl.DateTimeFormat('de-DE', {
        day: 'numeric',
        month: '2-digit',
        year: 'numeric',
    });

    return formatter.format(date);
});

const data = inject('data');

import axios from "axios";

const emit = defineEmits(['lead-deleted']);

const createOfferUrl = computed(() => {
    if (!data?.createOfferUrl) return null;
    const params = new URLSearchParams({
        company_id: props.lead.contact?.uuid ?? '',
        bsha_lead_id: props.lead.id,
        bsha_campaign_id: props.campaign.id,
    });
    return `${data.createOfferUrl}?${params.toString()}`;
});

const deleteLead = async () => {
    if (!confirm('Sind Sie sicher, dass Sie diesen Lead löschen möchten?')) {
        return;
    }
    try {
        const url = data.route.leads.destroy.replace(':leadId', props.lead.id);
        const response = await axios.delete(url);
        if (response.status === 200) {
            window.notyf.open({
                type: 'success',
                message: 'Lead deleted successfully!',
                duration: '2500',
                ripple: true,
                position: 'bottom right',
                dismissible: true
            });
            emit('lead-deleted', props.lead.id);
        }
    } catch (error) {
        console.error('Error deleting lead:', error);
        window.notyf.open({
            type: 'danger',
            message: 'Failed to delete lead.',
            duration: '2500',
            ripple: true,
            position: 'bottom right',
            dismissible: true
        });
    }
};

const isPhoneCallStage = computed(() => {
    const val = props.stage?.properties?.phone_call;
    return val == 1 || val === true || val === 'on';
});

const phoneCallStatus = computed(() => {
    if (!props.lead.activities || !props.lead.activities.length) {
        return null;
    }
    const callActivity = props.lead.activities.find(
        activity => activity.type === 'Call' &&
        (activity.is_done == 1 || activity.is_done === true) &&
        (activity.description === 'Telefonat erfolgreich' || activity.description === 'Telefonat nicht erfolgreich')
    );
    return callActivity ? callActivity.description : null;
});

const existingCallActivity = computed(() => {
    if (!props.lead.activities || !props.lead.activities.length) {
        return null;
    }
    return props.lead.activities.find(
        activity => activity.type === 'Call' &&
        (activity.description === 'Telefonat erfolgreich' || activity.description === 'Telefonat nicht erfolgreich')
    );
});

const logCallActivity = async (isSuccessful) => {
    const description = isSuccessful ? 'Telefonat erfolgreich' : 'Telefonat nicht erfolgreich';
    try {
        let response;
        if (existingCallActivity.value) {
            const url = data.route.activities.update
                .replace(':leadId', props.lead.id)
                .replace(':activityId', existingCallActivity.value.id);
            response = await axios.put(url, {
                description: description,
                is_done: 1
            });
        } else {
            const url = data.route.activities.store.replace(':leadId', props.lead.id);
            response = await axios.post(url, {
                lead_id: props.lead.id,
                activity_type: 'Call',
                activity_start_date: new Date().toISOString().slice(0, 19).replace('T', ' '),
                description: description,
                is_done: 1
            });
        }

        if (response.status === 200) {
            if (!props.lead.activities) {
                props.lead.activities = [];
            }

            if (existingCallActivity.value) {
                const idx = props.lead.activities.findIndex(act => act.id === response.data.leadActivity.id);
                if (idx !== -1) {
                    props.lead.activities[idx] = response.data.leadActivity;
                }
            } else {
                props.lead.activities.unshift(response.data.leadActivity);
            }

            props.lead.activities = [...props.lead.activities];

            window.notyf.open({
                type: 'success',
                message: 'Aktivität gespeichert!',
                duration: '2500',
                ripple: true,
                position: 'bottom right',
                dismissible: true
            });
        }
    } catch (error) {
        console.error('Error logging call activity:', error);
        window.notyf.open({
            type: 'danger',
            message: 'Aktivität konnte nicht gespeichert werden.',
            duration: '2500',
            ripple: true,
            position: 'bottom right',
            dismissible: true
        });
    }
};
const enableDragDrop = computed(() => {
    const val = props.campaign.settings?.enable_drag_drop;
    if (val === undefined || val === null) {
        return true;
    }
    return val == 1 || val === true || val === '1' || val === 'on';
});

</script>

<template>
    <div class="lead-item card mb-3 p-2 bg-light border gap-1" :data-lead-id="lead.id">
        <!-- Drag Handle -->
        <span v-if="enableDragDrop"
              class="drag-handle"
              style="
            display: inline-block;
            width: 20px;
            cursor: grab;
            margin-bottom: 5px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move align-middle" style="pointer-events: none;"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
        </span>

        <div class="d-flex align-items-center">
            <User class="flex-shrink-0"/>
            <span class="ms-2 lead-name">
                <a target="_blank" :href="data.route.contacts.edit.replace(':contactId', lead.contact.id)">
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
        <div v-if="lead.contact?.tags.length > 0" class="d-flex align-items-center">
            <Tag class="me-2 flex-shrink-0" />
            <ul class="list-unstyled d-flex flex-wrap m-0" style="gap: 2px 3px;">
                <li v-for="tag in lead.contact.tags" :key="tag.id" class="badge rounded-pill bg-info fw-light">{{ tag.name }}</li>
            </ul>
        </div>
        <div v-if="lead?.tags.length > 0 " class="d-flex align-items-center">
            <Tag class="me-2 flex-shrink-0" />
            <ul class="list-unstyled d-flex flex-wrap m-0 lead-tags mt-3" style="gap: 2px 3px;">
                <li v-for="tag in lead.tags" :key="tag.id" class="badge rounded-pill bg-success fw-light">{{ tag.name }}</li>
            </ul>
        </div>
        <div v-if="lead.next_call_activity" class="d-flex align-items-center">
            <Phone />
            <span class="ms-2">
                {{ nextCallActivityDate }}
            </span>
        </div>
        <div v-if="leadCreatedDate" class="d-flex align-items-center mt-2 pt-2 border-top">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="ms-2 text-muted" style="font-size: 0.85rem;">
                Created: {{ leadCreatedDate }}
            </span>
        </div>
        <a
            v-if="createOfferUrl"
            :href="createOfferUrl"
            target="_blank"
            class="btn btn-sm btn-outline-primary mt-2"
            title="Neues Angebot erstellen"
        >
            + Neues Angebot
        </a>

        <!-- Phone Call Stage UI -->
        <div v-if="isPhoneCallStage" class="mt-2 border-top pt-2">
            <div v-if="phoneCallStatus" class="d-flex align-items-center">
                <span class="badge w-100 py-2 fs-7" :class="phoneCallStatus === 'Telefonat erfolgreich' ? 'bg-success' : 'bg-danger'">
                    <i class="fas me-1" :class="phoneCallStatus === 'Telefonat erfolgreich' ? 'fa-phone-alt' : 'fa-phone-slash'"></i>
                    {{ phoneCallStatus }}
                </span>
            </div>
            <div v-else class="d-flex gap-2">
                <button @click="logCallActivity(true)" class="btn btn-sm btn-success w-50 py-1" style="font-size: 0.65rem;" title="Telefonat erfolgreich">
                    <i class="fas fa-phone-alt me-1"></i> Erfolgreich
                </button>
                <button @click="logCallActivity(false)" class="btn btn-sm btn-outline-danger w-50 py-1" style="font-size: 0.65rem;" title="Telefonat nicht erfolgreich">
                    <i class="fas fa-phone-slash me-1"></i> Nicht erfolgreich
                </button>
            </div>
        </div>

        <span class="delete-icon" @click="deleteLead" title="Lead löschen">
            <i class="fas fa-trash text-danger" style="font-size: 1.1rem; vertical-align: middle;"></i>
        </span>
        <LeadDetails :lead-id="lead.id" :campaign-id="campaign.id" :key="lead.contact.id"/>
    </div>
</template>

<style lang="scss">
    .drag-handle {
        color: #a7a7a7;
        &:hover {
            color: rgb(60 60 60);
        }
    }
</style>
