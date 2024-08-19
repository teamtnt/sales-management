<template>
  <div class="form-group mb-3">
    <label for="stage-select-select">Move Lead to stage:</label>
    <select id="stage-select" class="form-select mt-2" v-model="selectedOption" @change="handleChange">
      <option value="" disabled>Select an option</option>
      <option v-for="option in transformOptions" :key="option.id" :value="option.id">
        {{ option.name }}
      </option>
    </select>
  </div>
</template>

<script setup>
import { computed, ref, inject } from 'vue'
import { useI18n } from "vue-i18n";

const props = defineProps({
    modelId: {
        type: Number,
        required: false
    },
    options: {
        type: Array,
        required: true
    },
    transformOptions: {
        type: Boolean,
        required: false
    },
    selectedOption: {
        type: Number,
        required: false
    }
})

const data = inject('data')
const selectedOption = ref(props.selectedOption)
const { t } = useI18n();

const transformOptions = computed(() => {
    if(props.transformOptions) {
        return props.options.map((option) => {
            return {
                id: option.id,
                name: option.name
            }
        })
    }

    return props.options
})

const handleChange = async () => {
    if (selectedOption.value) {
        try {
            const response = await axios.post(data.route.leads.leadStageChange.replace(':leadId',props.modelId),{
                stage_id: selectedOption.value
            })

            if (response.status === 200) {
                window.notyf.open({
                    type: "success",
                    message: t("Lead moved to another stage!"),
                    duration: "2500",
                    ripple: true,
                    position: "bottom right",
                    dismissible: true,
                });
            }
        } catch (error) {
            console.error('Error fetching data:', error)
        }
    }
}
</script>
