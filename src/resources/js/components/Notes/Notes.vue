<script setup>
import { onMounted, reactive, ref } from "vue";

const props = defineProps({
    url: {
        type: String
    },
    deleteUrl: {
        type: String
    },
    leadId: {
        type: String
    },
    leadNotes: {
        type: Array
    }
})

const notes = ref([]);
const note = ref("");

onMounted(() => {
    notes.value = [...props.leadNotes]
});

const handleFormSubmit = () => {

    let formData = new FormData();
    formData.append('note', note.value)
    formData.append('lead_id', props.leadId)

    axios.post(props.url, formData, {
        headers: {
            "Content-Type": "application/json"
        }
    }).then((response) => {
        if(response.status === 200) {
            notes.value = [...props.leadNotes, response.data.leadNote]
            note.value = "";
        }
    }).catch((error) => {
        console.log(error)
        // if (error.response.status === 422) {
        //     errors.value = error.response.data.errors
        // }
    });
}

const deleteNote = (id) => {
    axios.delete(props.deleteUrl.replace(":noteId", id)).then((response) => {
        if(response.status === 200) {
            notes.value = notes.value.filter((note) => note.id !== id);
        }
    }).catch((error) => {
        console.log(error);
    });
};

</script>

<template>
    <form @submit.prevent="handleFormSubmit" id="notes-form" ref="notesForm">
        <div>
            <label for="note" class="form-label fw-bold">
                <span class="d-flex align-items-center">
                    <i class="align-middle me-2 fas fa-fw fa-clipboard-list"></i>{{ $t("Notes")}}
                </span>
            </label>
            <div class="input-group d-flex align-items-center">
                <input id="note" v-model="note" class="form-control" name="note" :placeholder="$t('Note')"/>
                <button type="submit" class="btn btn-success">Add Note</button>
            </div>
            <small class="text-info"><em>*press Enter to save note</em></small>
        </div>
    </form>
    <hr>
    <div class="d-flex flex-column">
        <div v-for="note in notes" :key="note.id" class="note mb-3">
            <div class="d-flex flex-column">
                <p class="mb-1">{{ note.note }}</p>
                <span style="font-size: 11px;"><em><strong>Created by</strong> {{ note.created_by }} THIS will be user name</em></span>
<!--                TODO: format vremena-->
                <span style="font-size: 11px;"><strong><em>{{ note.created_at}}</em></strong></span>
            </div>
            <div class="d-flex gap-1">
                <span class="delete-icon" @click="deleteNote(note.id)">
                    <i class="align-middle me-2 fas fa-fw fa-trash text-danger"></i>
                </span>
            </div>
        </div>
    </div>
</template>

