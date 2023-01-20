<template>
    <div class="card">
        <form :action="storeUrl"
              method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrfToken()">
            <input type="hidden" name="property_type_id" :value="property.property_type_id">
            <input type="hidden" name="id" :value="property.id">
            <div class="row">
                <div class="col-md-8">
                    <template v-for="section in sectionsData">
                        <anchor-section
                            :id="section.id"
                            :title="section.title"
                        >
                            <component :is="section.component" v-bind="{...section.props, 'property':property, 'required-fields':requiredFields}"></component>
                        </anchor-section>
                    </template>
                    <slot></slot>
                </div>
                <div class="col-md-4">
                    <div class="card-body property-form-tooltip">
                        <div v-show="tooltip.show" class="text-center">
                            <small>{{ tooltip.text }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button type="submit" class="btn btn-primary">{{ $t('Save') }}</button>
            </div>
        </form>
    </div>
</template>
<script>
    import BasicInformationSection from "./Sections/BasicInformationSection.vue";
    import MultimediaSection from "./Sections/MultimediaSection.vue";
    import DetailsSection from "./Sections/DetailsSection.vue";
    import EnergyCertificateSection from "./Sections/EnergyCertificateSection.vue";
    import DescriptionSection from "./Sections/DescriptionSection.vue";
    import ContactDataSection from "./Sections/ContactDataSection.vue";

    export default {
        components: {
            BasicInformationSection,
            MultimediaSection,
            DetailsSection,
            EnergyCertificateSection,
            DescriptionSection,
            ContactDataSection,
        },
        props: {
            sections: {
                type: Array,
                default: function () {
                    return []
                }
            },
            propertyData: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            requiredFields: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            tooltipData: {
                type: Object,
                default: function () {
                    return {
                        show: false,
                        text: '',
                    }
                }
            },
            storeUrl: {
                type: String,
                default: null
            },
        },
        data() {
            return {
                sectionsData: this.sections,
                property: this.propertyData,
                tooltip: this.tooltipData
            };
        },
        mounted() {
            EventBus.$on('show-tooltip', (data) => {
                this.tooltip = data;
            });
        },
        methods: {
            csrfToken() {
                return csrfToken();
            }
        }
    }
</script>