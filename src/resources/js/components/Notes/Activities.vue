<script setup>
import {onMounted, ref} from "vue";


const props = defineProps({
    url: {
        type: String
    },
    fetchUrl: {
        type: String
    },
    deleteUrl: {
        type: String
    },
    leadId: {
        type: Number
    },
    leadActivities: {
        type: Array
    }
})

const activities = ref([]);
const activity_description = ref("");
const activity_type = ref("Call");
//set default date to tomorrow at 00:00
const activity_start_date = ref(new Date(new Date().getTime() + 24 * 60 * 60 * 1000).toISOString().slice(0, 16).slice(0, 11) + "00:00");
const activity_end_date = ref("");
const errors = ref({});
const submitting = ref(false)

onMounted(() => {
    fetchActivities()
});

function fetchActivities() {
    axios.get(props.fetchUrl, {
        params: {
            lead_id: props.leadId
        }
    }).then((response) => {
        if (response.status === 200) {
            activities.value = [...response.data.leadActivities]
        }
    }).catch((error) => {
        console.log(error.message)
    })
}

const handleFormSubmit = () => {
    submitting.value = true;

    let formData = new FormData();
    formData.append('description', activity_description.value)
    formData.append('activity_type', activity_type.value)
    formData.append('activity_start_date', activity_start_date.value)
    formData.append('activity_end_date', activity_end_date.value)
    formData.append('lead_id', props.leadId)

    axios.post(props.url, formData, {
        headers: {
            "Content-Type": "application/json"
        }
    }).then((response) => {
        if (response.status === 200) {
            activities.value = [...activities.value, response.data.leadActivity]
            activity_description.value = "";
            submitting.value = false;
            errors.value = {};

            window.notyf.open({
                type: "success",
                message: "Activity saved!",
                duration: "2500",
                ripple: true,
                position: "bottom right",
                dismissible: true,
            });
        }
    }).catch((error) => {
        if (error.response.status === 422) {
            errors.value = error.response.data.errors
            console.log(error.response.data.errors)
            submitting.value = false;
        }
    });
}

const deleteActivity = (id) => {
    axios.delete(props.deleteUrl.replace(":activityId", id)).then((response) => {
        if (response.status === 200) {
            activities.value = activities.value.filter((activity) => activity.id !== id);

            window.notyf.open({
                type: "success",
                message: "Activity deleted!",
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

function formatDate(dateString) {
    const date = new Date(dateString);

    let day = date.getUTCDate().toString().padStart(2, '0');
    let month = (date.getUTCMonth() + 1).toString().padStart(2, '0'); // getUTCMonth() returns 0-11
    let year = date.getUTCFullYear();
    let hours = date.getUTCHours().toString().padStart(2, '0');
    let minutes = date.getUTCMinutes().toString().padStart(2, '0');

    return `${day}.${month}.${year} ${hours}:${minutes}`;
}

</script>

<template>
    <form @submit.prevent="handleFormSubmit" id="activities-form" ref="activitiesForm">
        <div>
            <label for="note" class="form-label fw-bold">
                <span class="d-flex align-items-center">
                    <i class="align-middle me-2 fas fa-fw fa-clipboard-list"></i>{{ $t("Activities") }}
                </span>
            </label>
            <div class="form-group mb-3">
                <label for="start_date">Typ</label>
                <select name="activity_type" v-model="activity_type" id="note_type" class="form-select mt-2">
                    <option value="Call">Call</option>
                    <option value="Meeting">Meeting</option>
                    <option value="E-Mail">E-Mail</option>
                    <option value="Task">Task</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="start_date">Start Datum</label>
                <input type="datetime-local" class="form-control" id="activity_start_date" v-model="activity_start_date" :class="{'is-invalid': errors?.activity_start_date}">
                <small v-if="errors && errors.activity_start_date" class="invalid-feedback">
                    {{ errors.activity_start_date[0] }}
                </small>
            </div>
            <div class="form-group mb-3">
                <label for="end_date">Ende Datum</label>
                <input type="datetime-local" class="form-control" id="activity_end_date" v-model="activity_end_date">
            </div>

            <div class="form-group">
                <label for="start_date">Beschreibung</label>
            <textarea id="activity" v-model="activity_description" class="form-control" :class="{'is-invalid': errors?.description}"
                      name="activity" />

            <small v-if="errors && errors.description" class="invalid-feedback">
                {{ errors.description[0] }}
            </small>
            </div>
            <button type="submit" class="btn btn-success mt-2" :disabled="submitting">Add Activity</button>

        </div>
    </form>
    <hr>
    <div class="d-flex flex-column">
        <div v-for="activity in activities" :key="activity.id" class="note mb-3">
            <div class="d-flex flex-column">
                <p class="mb-1">{{ activity.description }}</p>
                <span>{{ activity.type }}</span>
                <span style="font-size: 11px;" v-if="activity.user"><em><strong>{{ activity.user.full_name }}</strong></em></span>
                <span style="font-size: 11px;">Start Datum: <strong><em>{{ formatDate(activity.start_date) }}</em></strong></span>
            </div>
            <div class="d-flex gap-1">
                <span class="delete-icon" @click="deleteActivity(activity.id)">
                    <i class="align-middle me-2 fas fa-fw fa-trash text-danger"></i>
                </span>
            </div>
        </div>
    </div>
</template>

