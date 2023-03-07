<script setup>
 import { onMounted, ref } from "vue";
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
         type:String,
     },
     trackBy: {
         type: String
     }
 })

const selectedOptions = ref([])

 onMounted(() => {
     if (props.selected.length) {
         selectedOptions.value = props.selected
     }
 })
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
