<script setup>
import { provide, reactive, ref, computed, onMounted } from "vue";
import LeadList from "./LeadList.vue";
import Search from "../SVG/Search.vue";
import axios from 'axios';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

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
    },
    emails: {
        type: Object,
        required: false
    },
    initialSearch: {
        type: String,
        required: false,
        default: ''
    }
})

const globalSearchQuery = ref('');
const globalSearchResults = ref({});
const isGlobalSearching = ref(false);
const searchInputRef = ref(null);

const totalResultsCount = computed(() => {
    return Object.values(globalSearchResults.value).reduce((sum, stageResults) => {
        return sum + (Array.isArray(stageResults) ? stageResults.length : 0);
    }, 0);
});

const data = reactive({
    route: props.routes,
    emails: props.emails,
    stages: props.stages,
    globalSearchQuery,
    globalSearchResults,
    isGlobalSearching
});

provide('data', data);

const handleGlobalSearch = async (event) => {
    const query = event.target.value.trim();
    globalSearchQuery.value = query;
    
    if (query.length === 0) {
        globalSearchResults.value = {};
        isGlobalSearching.value = false;
        return;
    }

    isGlobalSearching.value = true;
    
    try {
        const { data: { searchResults } } = await axios.get(`/sales/campaign/${props.campaign.id}/pipeline/${props.campaign.pipeline.id}/search-all`, {
            params: { query }
        });
        
        globalSearchResults.value = searchResults;
    } catch (error) {
        console.error('Error fetching global search results:', error);
        globalSearchResults.value = {};
    }
};

const clearSearch = () => {
    globalSearchQuery.value = '';
    globalSearchResults.value = {};
    isGlobalSearching.value = false;
    if (searchInputRef.value) {
        searchInputRef.value.value = '';
    }
};

// Trigger search if initialSearch is provided
onMounted(() => {
    if (props.initialSearch && props.initialSearch.trim().length > 0) {
        // Set the input value
        if (searchInputRef.value) {
            searchInputRef.value.value = props.initialSearch;
        }
        // Trigger the search
        handleGlobalSearch({ target: { value: props.initialSearch } });
    }
});


</script>

<template>
    <transition appear>
        <div>
            <!-- Global Search Bar - Modern Design -->
            <div class="mb-4">
                <div class="global-search-container">
                    <div class="search-wrapper">
                        <div class="search-icon-wrapper">
                            <Search :width="20" :height="20" />
                        </div>
                        <input 
                            ref="searchInputRef"
                            class="global-search-input" 
                            type="search" 
                            name="global-search"
                            :placeholder="t('Search by name, email, company...')"
                            @input="handleGlobalSearch"
                            autocomplete="off"
                        >
                        <button 
                            v-if="globalSearchQuery" 
                            @click="clearSearch"
                            class="clear-search-btn"
                            :title="t('Clear search')"
                        >
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <transition name="fade">
                            <div v-if="isGlobalSearching && globalSearchQuery" class="search-status-badge">
                                <div class="status-indicator"></div>
                                <span class="status-text">
                                    {{ t('Searching across all stages') }}
                                    <span v-if="totalResultsCount > 0" class="results-count">
                                        · {{ totalResultsCount }} {{ t('results found') }}
                                    </span>
                                </span>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>

            <!-- Stages Row -->
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
        </div>
    </transition>
</template>

<style scoped>
.global-search-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 4px;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.2);
}

.search-wrapper {
    background: white;
    border-radius: 12px;
    padding: 16px 20px;
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
}

.search-wrapper:focus-within {
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

.search-icon-wrapper {
    color: #667eea;
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.global-search-input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 16px;
    font-weight: 500;
    color: #2d3748;
    background: transparent;
    padding: 0;
}

.global-search-input::placeholder {
    color: #a0aec0;
    font-weight: 400;
}

.global-search-input::-webkit-search-cancel-button {
    display: none;
}

.clear-search-btn {
    background: none;
    border: none;
    color: #a0aec0;
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.clear-search-btn:hover {
    color: #667eea;
    background: #f7fafc;
}

.search-status-badge {
    position: absolute;
    top: -12px;
    right: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    z-index: 10;
}

.status-indicator {
    width: 6px;
    height: 6px;
    background: #48bb78;
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.6;
        transform: scale(1.2);
    }
}

.status-text {
    white-space: nowrap;
}

.results-count {
    font-weight: 700;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
    transform: translateY(-5px);
}

@media (max-width: 768px) {
    .search-wrapper {
        padding: 12px 16px;
    }
    
    .global-search-input {
        font-size: 14px;
    }
    
    .search-status-badge {
        position: relative;
        top: 0;
        right: 0;
        margin-top: 12px;
        width: 100%;
        justify-content: center;
    }
}
</style>
