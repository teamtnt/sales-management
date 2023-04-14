<script setup>
import { onMounted, ref } from "vue";


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
const errors = ref({});
const submitting = ref(false)

onMounted(() => {
    notes.value = [...props.leadNotes]
});

const handleFormSubmit = () => {
    submitting.value = true;

    let formData = new FormData();
    formData.append('note', note.value)
    formData.append('lead_id', props.leadId)

    axios.post(props.url, formData, {
        headers: {
            "Content-Type": "application/json"
        }
    }).then((response) => {
        if(response.status === 200) {
            notes.value = [...notes.value, response.data.leadNote]
            note.value = "";
            submitting.value = false;
            errors.value = {};

            window.notyf.open({
                type: "success",
                message: "Note saved!",
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
            submitting.value = false;
        }
    });
}

const deleteNote = (id) => {
    axios.delete(props.deleteUrl.replace(":noteId", id)).then((response) => {
        if(response.status === 200) {
            notes.value = notes.value.filter((note) => note.id !== id);

            window.notyf.open({
                type: "success",
                message: "Note deleted!",
                duration: "2500",
                ripple: true,
                position: "bottom right",
                dismissible: true,
            });
        }
    }).catch((error) => {
        console.log(error.message);

        window.notyf.open({
            type: "danger",
            message: error.message,
            duration: "2500",
            ripple: true,
            position: "bottom right",
            dismissible: true,
        });
    });
};

const isNotEmpty = (obj) => {
    return Object.keys(obj).length !== 0;
}

const formatDate = (timestamp) => {
    let date = new Date(timestamp * 1000);
    const formatDate = new Intl.DateTimeFormat("default", {
        year: "numeric",
        month: "numeric",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
    });

   return formatDate.format(date);
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
                <input id="note" v-model="note" class="form-control" :class="{'is-invalid': isNotEmpty(errors)}" name="note" :placeholder="$t('Note')"/>
                <button type="submit" class="btn btn-success" :disabled="submitting">Add Note</button>
            <small v-if="errors && errors.note" class="invalid-feedback">
              {{ errors.note[0] }}
            </small>
            </div>
        </div>
    </form>
    <hr>
    <div class="d-flex flex-column">
        <div v-for="note in notes" :key="note.id" class="note mb-3">
            <div class="d-flex flex-column">
                <p class="mb-1">{{ note.note }}</p>
                <span style="font-size: 11px;"><em><strong>Created by</strong> ID:{{ note.created_by }} <strong>this will be user name</strong></em></span>
                <span style="font-size: 11px;"><strong><em>{{ formatDate(note.created_at) }}</em></strong></span>
            </div>
            <div class="d-flex gap-1">
                <span class="delete-icon" @click="deleteNote(note.id)">
                    <i class="align-middle me-2 fas fa-fw fa-trash text-danger"></i>
                </span>
            </div>
        </div>
    </div>
</template>
