<script setup>
import { inject, ref} from "vue";
import { useLeadListProperties } from '@/composables/useLeadListProperties.js';
import { useI18n } from 'vue-i18n';
import { useInfiniteScroll } from '@vueuse/core'

import Search from "../SVG/Search.vue";
import LeadItem from "./LeadItem.vue";

const props = defineProps({
    campaign: {
        type: Object,
        required: true
    },
    leadsCount: {
        type: [Number, Object],
        required: true,
    },
    leads: {
        type: [Array,Object],
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
const { cardStyle, stageTitle, stageIdAttributes, getLeads, loadMoreLeads, handleSearch } = useLeadListProperties(props, t);
const { route: {list}} = inject('data');

const el = ref(null);
const scrollContainer = ref(null);

useInfiniteScroll(
    scrollContainer,
    () => {
        loadMoreLeads()
    },
    {
        distance: 20,
        direction: 'bottom',
        canLoadMore: () => {
            return Object.keys(props.stage).length === 0 ?
                getLeads.value.length < props.leadsCount :
                getLeads.value.length < props.leadsCount[props.stage.id];
        }
    }
)
</script>

<template>
<div class="campaign-card" >
    <div class="card" :style="cardStyle">
        <div class="card-header">
            <div v-if="Object.keys(props.stage).length !== 0" class="card-actions float-end">
                <div class="dropdown position-relative">
                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round"
                             class="feather feather-more-horizontal align-middle">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a :href="list.newList.replace(':stageId', stage.id)" class="dropdown-item"
                          >{{ $t("Create New List") }}</a>
                    </div>
                </div>
            </div>
            <h5 class="card-title">{{ stageTitle }}</h5>
            <h6 v-if="stage.description" class="card-subtitle text-muted mb-2">{{ stage.description }}</h6>

            <div class="input-group">
                 <span class="input-group-text">
                     <Search />
                 </span>

                <input class="form-control lead-search"
                       id=""
                       type="search" name="lead-search"
                       placeholder="Search leads by name or email..."
                       @input="handleSearch">
            </div>
        </div>

        <div class="card-body scroll" ref="scrollContainer">
            <div :id="stageIdAttributes.id" :data-stage-id="stageIdAttributes.dataStageId">
                <lead-item v-for="lead in getLeads" :key="lead.id" :lead="lead" :campaign="campaign"/>
                <div class="card mb-3 px-2 py-4 cursor-grab border-dashed align-items-center">
                    <span style="font-size: 10px;"><i>Drag / drop area</i></span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
