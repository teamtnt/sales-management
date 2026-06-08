import { computed, ref, inject, watch } from 'vue';
import axios from 'axios';

const PAGE_SIZE = 20;

export function useLeadListProperties(props, t) {
    const filteredLeads = ref([]);
    const loadedLeads = ref(PAGE_SIZE);
    const isLoadingMore = ref(false);
    const data = inject('data', {});

    const stageId = computed(() => (props.stage && props.stage.id) ? props.stage.id : 0);

    const totalCount = computed(() => {
        return Object.keys(props.stage).length === 0
            ? props.leadsCount
            : props.leadsCount[props.stage.id];
    });

    // The server now only sends the first page of leads per stage. We keep a
    // local, growable copy here and append additional pages fetched on scroll.
    const serverLeads = ref([
        ...(Object.keys(props.stage).length === 0
            ? (props.leads || [])
            : (props.leads?.[props.stage.id] || []))
    ]);

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
            return `${props.stage.name} (${props.leadsCount[props.stage.id]})`;
        }

        return `${t('Leads')} (${props.leadsCount})`;
    });

    const stageIdAttributes = computed(() => {
        const id = Object.keys(props.stage).length === 0 ? 'leads' : `stage-${props.stage.id}`;
        const dataStageId = Object.keys(props.stage).length !== 0 ? props.stage.id : 0;

        return {
            id, dataStageId
        };
    });

    const getLeads = computed(() => {
        // If global search is active, use global results for this stage
        if (data.isGlobalSearching && data.globalSearchQuery) {
            const globalResults = data.globalSearchResults?.[stageId.value] || [];
            return globalResults.slice(0, loadedLeads.value);
        }

        // Otherwise use local filtered leads or the locally-buffered server leads
        const leads = filteredLeads.value.length > 0 ? filteredLeads.value : serverLeads.value;
        return leads.slice(0, loadedLeads.value);
    });

    const loadMoreLeads = async () => {
        // While searching (global or in-stage), all matching leads are already
        // loaded client-side, so just reveal more of them.
        const isSearching = (data.isGlobalSearching && data.globalSearchQuery)
            || filteredLeads.value.length > 0;
        if (isSearching) {
            loadedLeads.value += 10;
            return;
        }

        // Reveal more of what we've already fetched before hitting the server.
        if (loadedLeads.value < serverLeads.value.length) {
            loadedLeads.value += 10;
            return;
        }

        // Nothing left to fetch, or a fetch is already in flight.
        if (isLoadingMore.value || serverLeads.value.length >= totalCount.value) {
            return;
        }

        isLoadingMore.value = true;
        try {
            const campaignId = props.campaign.id;
            const pipelineId = props.campaign.pipeline.id;
            const { data: { leads } } = await axios.get(
                `/sales/campaign/${campaignId}/pipeline/${pipelineId}/stage/${stageId.value}/leads`,
                { params: { offset: serverLeads.value.length, limit: PAGE_SIZE } }
            );
            serverLeads.value.push(...leads);
            loadedLeads.value += 10;
        } catch (error) {
            console.error('Error loading more leads:', error);
        } finally {
            isLoadingMore.value = false;
        }
    };

    const handleSearch = async (event) => {
        if (event.target.value.length === 0) {
            loadedLeads.value = PAGE_SIZE;
            filteredLeads.value = [];
            return;
        }

        const campaignId = props.campaign.id;
        const pipelineId = props.campaign.pipeline.id;
        const stageId = props.stage.id || 0;
        const lowercaseQuery = event.target.value.toLowerCase().trim();

        try {
            const {data: {searchResults}} = await axios.get(`/sales/campaign/${campaignId}/pipeline/${pipelineId}/stage/${stageId}/search`, {
                params: {
                    query: lowercaseQuery,
                },
            });
            filteredLeads.value = searchResults;

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    // Watch for global search changes and reset local filters
    watch(() => data.globalSearchQuery, (newValue) => {
        if (newValue && newValue.length > 0) {
            // Clear local search when global search is active
            filteredLeads.value = [];
        }
    });

    return {
        cardStyle,
        stageTitle,
        stageIdAttributes,
        getLeads,
        loadMoreLeads,
        handleSearch
    };
}
