<template>
    <form @submit.prevent="handleFormSubmit" ref="form">
        <div class="mb-3">
            <label for="from_email" class="form-label">{{ $t('From')}}</label>
            <select id="from_email" name="from_email" class="form-control" :class="{'is-invalid': errors?.from_email}">
                <option value="" selected>{{ $t('Select')}}</option>
                <option v-for="(option, email) in data.emails" :value="email" :key="email">{{ option }}</option>
            </select>
            <small v-if="errors && errors.from_email" class="invalid-feedback">
                {{ errors.from_email[0] }}
            </small>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">{{ $t('Subject') }}</label>
            <input type="text" name="subject" class="form-control" id="subject" :placeholder="$t('Enter subject')" :class="{'is-invalid': errors?.subject}">
            <small v-if="errors && errors.subject" class="invalid-feedback">
                {{ errors.subject[0] }}
            </small>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">{{ $t('Message')}}</label>
            <textarea name="body" id="body" class="form-control" rows="4" :class="{'is-invalid': errors?.body}"></textarea>
            <small v-if="errors && errors.body" class="invalid-feedback">
                {{ errors.body[0] }}
            </small>
        </div>
        <div class="my-3">
            <button type="submit" class="btn btn-success me-2 w-100" :disabled="submitting">
                <span class="d-flex align-items-center justify-content-center">
                    <span v-if="submitting" class="spinner spinner-border spinner-border-sm text-light me-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </span>{{ $t("Send Message") }}
                </span>
            </button>
        </div>
    </form>
</template>

<script setup>
import { ref, inject } from "vue";

const form = ref(null);
const errors = ref({});
const submitting = ref(false);
const data = inject('data');

console.log(data.route)
const handleFormSubmit = () => {
    let formData = new FormData(form.value)

    submitting.value = true;
    axios.post(data.route, formData, {
        headers: {
            "Content-Type": "application/json"
        }
    }).then((response) => {
        if (response.status === 200) {
            submitting.value = false;
            errors.value = {};

            window.notyf.open({
                type: "success",
                message: response.data.message,
                duration: "2500",
                ripple: true,
                position: "bottom right",
                dismissible: true,
            });

            form.value.reset();
        }
    }).catch((error) => {
        if (error.response.status === 422) {
            errors.value = error.response.data.errors
            submitting.value = false;
        }
    });
}
</script>

