<script setup>
import {onMounted, ref} from "vue";
import Multiselect from 'vue-multiselect'

const props = defineProps({
    selected: {
        type: Array
    },
    options: {
        type: Array,
        required: true
    },
    name: {
        type: String
    },
    label: {
        type: String
    },
    placeholder: {
        type: String
    },
    labelBy: {
        type: String,
    },
    trackBy: {
        type: String
    },
    syncTagsUrl: {
        type: String
    },
    modelId: {
        type: String
    }
})

const selectedOptions = ref([])

onMounted(() => {
    if (props.selected.length) {
        selectedOptions.value = props.selected
    }
})

function syncTags(option, id) {
    if (props.syncTagsUrl) {
        let formData = new FormData();
        formData.append('contactId', props.modelId)
        for (let i = 0; i < selectedOptions.value.length; i++) {
            formData.append('tags[]', selectedOptions.value[i].id);
        }

        axios.post(props.syncTagsUrl, formData, {
            headers: {
                "Content-Type": "application/json"
            }
        }).then((response) => {
            if (response.status === 200) {
                window.notyf.open({
                    type: "success",
                    message: "Tags synced!",
                    duration: "2500",
                    ripple: true,
                    position: "bottom right",
                    dismissible: true,
                });
            }
        }).catch((error) => {
            console.log(error.message)
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        });
    }
}
</script>

<template>
    <div class="mb-3">
        <span class="d-block form-label">{{ label }}</span>
        <multiselect
            v-model="selectedOptions"
            :options="options"
            :multiple="true"
            :close-on-select="false"
            :placeholder="placeholder"
            :label="labelBy"
            :track-by="trackBy"
            @remove="syncTags"
            @select="syncTags"
        >
        </multiselect>
        <input v-for="(selectedOption) in selectedOptions"
               type="hidden"
               :name="name"
               :value=selectedOption.id
               :key="selectedOption.id"
        >
    </div>
</template>

<style>
@import "vue-multiselect/dist/vue-multiselect.css";

.multiselect__tags {
    border: 1px solid #ced4da !important;
}
</style>
