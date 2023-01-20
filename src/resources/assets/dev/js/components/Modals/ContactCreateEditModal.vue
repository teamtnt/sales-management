<template>
    <modal
        :title="title"
        :name="name"
        url="url"
        :close-on-approve="false"
    >
        <div v-if="errors" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <template v-for="error in errors">
                    <template v-for="message in error">
                        {{ message }} <br>
                    </template>
                </template>
            </div>
        </div>
        <form ref="form">
            <div class="mb-3 row">
                <label class="col-form-label col-sm-2 text-sm-right">{{ $t('Email') }} *</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" v-model="contact.email" required>
                    <label class="error small form-text invalid-feedback">This field is required.</label>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-2 text-sm-right">{{ $t('Title') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="contact.title">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-2 text-sm-right">{{ $t('Last name') }} *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="contact.last_name" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-2 text-sm-right">{{ $t('First name') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="contact.first_name">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-2 text-sm-right">{{ $t('Phone') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="contact.phone">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-2 text-sm-right">{{ $t('Mobile phone') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="contact.mobile_phone">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-2 text-sm-right">{{ $t('Website') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="contact.website">
                </div>
            </div>
        </form>
    </modal>

</template>
<script>
    import Modal from "../General/Modal.vue";

    export default {
        name: 'ContactCreateEditModal',
        components: {Modal},
        props: {
            name: {
                type: String,
                default: null,
            },
            title: {
                type: String,
                default: 'Edit contact'
            },
            url: {
                type: String,
                default: null,
            },
            redirectUrl: {
                type: String,
                default: null,
            },
            contactData: {
                type: Object,
                default: function () {
                    return {}
                }
            }
        },
        data() {
            return {
                contact: this.contactData,
                errors: null,
            };
        },
        mounted() {
            EventBus.$on('open-modal', (data) => {
                if (data.name !== this.name) {
                    return;
                }
                this.contact = data.data;
            });

            EventBus.$on('modal-approve', (data) => {
                console.log('approve')
                if (data.modalName !== this.name) {
                    return;
                }
                this.submit();
            });
            EventBus.$on('modal-cancel', (data) => {
                if (data.modalName !== this.name) {
                    return;
                }
                this.errors = null;
            });
        },
        methods: {
            async submit() {
                this.$refs['form'].reportValidity();
                let valid = this.$refs['form'].checkValidity();
                if (valid) {
                    let data = this.contact;
                    let submitted = await axios.post(this.url, data)
                        .then(resp => {
                            return resp;
                        }).catch(error => {
                            console.log(error.response.data)
                            this.errors = error.response.data.errors;
                            return false;
                        });
                    if (submitted) {
                        redirect(this.redirectUrl);
                    }

                }
            }
        }
    }
</script>