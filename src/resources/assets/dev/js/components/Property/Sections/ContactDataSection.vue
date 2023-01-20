<template>
    <div class="row">
        <div class="mb-3 col-md-12">
            <label class="form-label">{{ $t('Contact') }}</label>
            <select class="form-control" name="contact_id" v-model="property.contact_id">
                <option value="-1">{{ $t('Choose') }}</option>
                <option v-for="contact in contacts" :value="contact.id">{{ contact.display_name }}</option>
            </select>
        </div>
    </div>

</template>
<script>

    export default {
        props: {
            contacts: {
                type: Array,
                default: function () {
                    return []
                }
            },
            property: {
                type: Object,
                default: function () {
                    return {}
                }
            },
        },
        data() {
            return {};
        },
    }
</script>