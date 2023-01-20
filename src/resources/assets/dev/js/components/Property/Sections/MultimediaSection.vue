<template>
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <template v-for="(attachment, index) in property.attachments">
                    <file-input :file="attachment" :index="index" @delete="deleteFile(index)"></file-input>
                </template>
                <button type="button" class="btn btn-secondary" @click="addFile()">{{ $t('Add file') }}</button>
            </div>
        </div>
    </div>

</template>
<script>

    import FileInput from "../../General/FileInput.vue";

    export default {
        components: {FileInput},
        props: {
            sections: {
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
            emptyFile: {
                type: Object,
                default: function () {
                    return {
                        'id': null,
                        'index': null,
                        'custom_properties': {
                            'title': '',
                            'floorplan': false,
                        }
                    }
                }
            },
        },
        data() {
            return {
                propertyType: "kuca"
            };
        },
        methods: {
            addFile() {
                let emptyFile = structuredClone(this.emptyFile);
                this.property.attachments.push(emptyFile)
            },
            deleteFile(index) {
                this.property.attachments.splice(index, 1);
            }
        }
    }
</script>