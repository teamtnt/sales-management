<template>
    <modal
        :title="title"
        :name="name"
        :approve-txt="approveTxt"
        size="modal-sm"
    >
        <div>{{ $t('Are you sure?') }}</div>

    </modal>

</template>
<script>
    import Modal from "../General/Modal.vue";

    export default {
        name: 'ConfirmModal',
        components: {Modal},
        props: {
            name: {
                type: String,
                default: null,
            },
            title: {
                type: String,
                default: 'Confirm'
            },
            approveTxt: {
                type: String,
                default: 'Yes',
            },
            url: {
                type: String,
                default: null,
            },
            redirectUrl: {
                type: String,
                default: null,
            },
        },
        mounted() {
            EventBus.$on('modal-approve', (data) => {
                if (data.modalName !== this.name) {
                    return;
                }
                this.submit(data.data);
            });
        },
        methods: {
            async submit(data) {
                console.log(this.url);
                await axios.post(this.url, data)
                    .then(resp => {
                        return resp;
                    }).catch(error => {
                        return false;
                    });
                redirect(this.redirectUrl);
            }
        }
    }
</script>