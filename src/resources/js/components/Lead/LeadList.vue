<script setup>
import Search from "../SVG/Search.vue";
import LeadItem from "./LeadItem.vue";
import { computed } from "vue";
import { useI18n } from 'vue-i18n';

const props = defineProps({
    campaign: {
        type: Object,
        required: true
    },
    leadCount: {
        type: Number,
        required: true
    },
    leadStages: {
        type: Array,
        required: false,
        default: []
    },
    stage: {
        type: Object,
        required: false,
        default: {}
    }

})

const { t } = useI18n();
const cardStyle = computed(() => {
    if (props.stage && props.stage.color) {
        return {
            'border-top': `8px solid ${props.stage.color}`
        };
    }

    return {};
});

const stageTitle = computed(() => {
    if (props.stage && props.stage.name) {
        return `${props.stage.name} (${props.leadCount})`;
    }

    return `${t('Leads')} (${props.leadCount})`;
});

</script>

<template>
<div class="campaign-card">
    <div class="card" :style="cardStyle">
        <div class="card-header">

            <h5 class="card-title">{{ stageTitle }}</h5>
            <div class="input-group">
                 <span class="input-group-text">
                     <Search :width="15" :height="15"/>
                 </span>
<!--                TODO: stage-id(this is 0), campaign-id, pipeline-id -->
                <input class="form-control lead-search"
                       type="search" name="lead-search"
                       placeholder="Search leads by name or email...">
            </div>
        </div>
        <div class="card-body scroll">
            <div id="leads" data-stage-id="0">
                <lead-item v-for="lead in leadStages" :key="lead.id" :lead="lead" :campaign="campaign"/>
                <div class="card mb-3 px-2 py-4 cursor-grab border-dashed align-items-center">
                    <span style="font-size: 10px;"><i>Drag / drop area</i></span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>

</style>
