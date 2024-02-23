<script setup>
import { provide, reactive } from "vue";
import LeadList from "./LeadList.vue";

const props = defineProps({
    campaign: {
        type: Object,
        required: true
    },
    initialLeadsCount: {
        type: Number,
        required: true
    },
    initialLeads: {
        type: Array,
        required: true
    },
    leadsCount: {
        type: Object,
        required: true
    },
    stages: {
        type: Array,
        required: true
    },
    leads: {
        type: Object,
        required: true
    },
    routes: {
        type: Object,
        required: false
    }
})

const routes = reactive({
    route: props.routes,
});
provide('routes', routes);
</script>

<template>
    <transition appear>
        <div class="row" style="flex-wrap: unset;" id="pipeline" :data-pipeline-id="campaign.pipeline_id">
            <!--Initial Leads List-->
            <LeadList
                :campaign="campaign"
                :leads-count="initialLeadsCount"
                :leads="initialLeads"
                :key="0"
            />
            <!--  Other Leads List  -->
            <LeadList v-for="stage in stages" :key="stage.id"
                  :leads-count="leadsCount"
                  :campaign="campaign"
                  :stage="stage"
                  :leads="leads"
            />
        </div>
    </transition>
</template>

