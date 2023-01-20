<template>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <input type="hidden" :name="'attachments['+ index +'][id]'" v-model="file.id">
                <div v-if="file.id">
                    <span v-if="file.mime_type === 'application/pdf'"><i class="fas fa-file"></i></span>
                    <img :alt="file.file_name" :src="file.original_url" class="img-responsive mt-2" width="128" height="128"><br>
                </div>
                <div v-else class="mt-2">
                    <input type="file"
                           id="attachments" :name="'attachments['+ index +'][file]'"
                           accept="application/pdf, image/png, image/jpeg"
                           multiple>
                    <small>{{ $t('For best results, use an image at least 128px by 128px in .jpg format') }}</small>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label required">{{ $t('Title') }}</label>
            <input type="text" required class="form-control" :name="'attachments['+ index +'][title]'" v-model="file.custom_properties.title">
        </div>
        <div class="col-md-2">
            <label class="form-label">{{ $t('Floor plan') }}</label>
            <label class="form-control">
                <input type="checkbox" class="form-check-input" :name="'attachments['+ index +'][floorplan]'" value="1"
                       v-model="file.custom_properties.floorplan">
                <span class="form-check-label">{{ $t('Floor plan') }}</span>
            </label>
        </div>
        <div class="col-md-1">
            <button @click="deleteFile(index)">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>

</template>
<script>

    export default {
        props: {
            file: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            index: {
                type: Number,
                default: 0
            }
        },
        data() {
            return {
                propertyType: "kuca"
            };
        },
        methods: {
            deleteFile(index) {
                this.$emit('delete', index);
            }
        }
    }
</script>