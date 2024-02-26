import { computed, ref } from 'vue';
import axios from 'axios';
export function useLeadListProperties(props, t) {
    const filteredLeads = ref([]);

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
            id,
            dataStageId
        };
    });

    const leadsData = computed(() => {
        if (Object.keys(props.stage).length === 0) {
            return props.leads;
        }
        return props.leads[props.stage.id];
    });

    const getLeads = computed(() => {
        return filteredLeads.value.length > 0 ? filteredLeads.value : leadsData.value;
    });

    const handleSearch = async (event) => {
        const campaignId = props.campaign.id;
        const pipelineId = props.campaign.pipeline.id;
        const stageId = props.stage.id || 0;
        const lowercaseQuery = event.target.value.toLowerCase();

        try {
            const { data: { searchResults } } = await axios.get(`/sales/campaign/${campaignId}/pipeline/${pipelineId}/stage/${stageId}/search`, {
                params: {
                    query: lowercaseQuery,
                },
            });
            filteredLeads.value = searchResults;

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    return {
        cardStyle,
        stageTitle,
        stageIdAttributes,
        getLeads,
        handleSearch,
    };
}
