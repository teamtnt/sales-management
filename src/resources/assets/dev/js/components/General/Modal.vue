<template>
    <div class="modal fade" :id="name" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" :class="size" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" :aria-label="$t('Close')" @click="cancel()"></button>
                </div>
                <div class="modal-body m-3">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="cancel()">{{ $t('Close') }}</button>
                    <button type="button" class="btn btn-primary" @click="approve()">{{ $t(approveTxt) }}</button>
                </div>

            </div>
        </div>
    </div>

</template>
<script>
    export default {
        name: 'Modal',
        props: {
            name: {
                type: String,
                default: null,
            },
            title: {
                type: String,
                default: null
            },
            size: {
                type: String,
                default: 'modal-lg',
            },
            approveTxt: {
                type: String,
                default: 'Save',
            },
            closeOnApprove: {
                type: Boolean,
                default: true,
            },
            url: {
                type: String,
                default: null,
            },
        },
        data() {
            return {
                transferData: null,
            };
        },
        created() {
            if (this.name === null) {
                console.log('Modal must have a name!');
            }

            EventBus.$on('open-modal', (data) => {
                if (data.name == null) {
                    console.log('Modal name not provided');
                    return;
                }
                if (data.name !== this.name) {
                    return;
                }

                if (data.data != null) {
                    this.transferData = data.data;
                }

                data = this.resolveData(data.name, data.data);
                EventBus.$emit('modal-opened', data);
                this.$emit('modal-opened', data);

                this.opened = true;
            });

            EventBus.$on('close-modal', (data) => {
                if (data.name == null) {
                    console.log('Modal name not provided');
                    return;
                }
                if (data.name !== this.name) {
                    return;
                }

                EventBus.$emit('modal-closed', data);
                this.$emit('modal-closed', data);

                this.transferData = null;
                this.opened = false;
            });

        },
        methods: {
            approve() {
                let data = this.resolveData(this.name, this.transferData);
                if (this.closeOnApprove) {
                    $('#' + this.name).modal('hide')
                }
                EventBus.$emit('modal-approve', data);
                this.$emit('modal-approve', data);
            },
            cancel() {
                let data = this.resolveData(this.name, this.transferData);

                EventBus.$emit('modal-cancel', data);
                this.$emit('modal-cancel', data);
            },
            resolveData(modalName, data) {
                return {
                    modalName: modalName,
                    data: data,
                };
            },
        },
    }
</script>