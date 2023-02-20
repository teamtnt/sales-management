<template>
    <div>
        <label class="typo__label">Select assignees</label>
        <multiselect
            v-model="taskAssignees"
            :options="users"
            :multiple="true"
            :close-on-select="true"
            placeholder="Pick some"
            label="email"
            track-by="email"
        >
        </multiselect>

        <input v-for="(taskAssignee, key) in taskAssignees" type="hidden" name="assignees[]" :value=taskAssignee.id>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<script setup>
    import {onMounted, ref} from "vue";
    import Multiselect from 'vue-multiselect'

    const props = defineProps({
        assignees: {
            type: Array,
        },
        users: {
            type: Array,
        }
    })

    const taskAssignees = ref([]);

    onMounted(() => {
        if (props.assignees.length) {
            taskAssignees.value = props.assignees
        }
    })

</script>
