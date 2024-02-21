<script setup>
import LeadList from "./LeadList.vue";

const props = defineProps({
    campaign: {
        type: Object,
        required: true
    },
    leadInitialCount: {
        type: Number,
        required: true
    },
    leadInitialStages: {
        type: Array,
        required: true
    },
    stages: {
        type: Array,
        required: true
    }
})

</script>

<template>
    <div class="row" style="flex-wrap: unset;" id="pipeline" :data-pipeline-id="campaign.pipeline_id">
        <LeadList
            :campaign="campaign"
            :lead-count="leadInitialCount"
            :lead-stages="leadInitialStages"/>
        <LeadList v-for="stage in stages" :key="stage.id"
                  :lead-count="56"
                  :campaign="campaign"
                  :stage="stage"/>
    </div>
</template>

