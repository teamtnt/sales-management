<template>
    <div class="row">
        <div class="mb-3 col-md-6" v-if="typeof property.details.residentialEnergyCertificate.type !== 'undefined'">
            <label class="form-label">{{ $t('Residential Energy Certificate Type') }}</label>
            <select class="form-control" name="fields[residentialEnergyCertificate][type]" v-model="property.fields.residentialEnergyCertificate.type">
                <option value="-1">{{ $t('Choose') }}</option>
                <option v-for="residentialEnergyCertificateType in residentialEnergyCertificateTypes" :value="residentialEnergyCertificateType">{{ residentialEnergyCertificateType }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-6"
             v-if="typeof property.details.residentialEnergyCertificate.energyNeed !== 'undefined'"
             v-show="property.fields.residentialEnergyCertificate.type === 'need'"
        >
            <label class="form-label">{{ $t('Energy Need') }}</label>
            <input type="text" class="form-control" name="fields[residentialEnergyCertificate][energyNeed]" v-model="property.fields.residentialEnergyCertificate.energyNeed"
                   @click="showTooltip($t('help text example.'))"
                   @blur="hideTooltip()">
        </div>
        <div class="mb-3 col-md-6"
             v-if="typeof property.details.residentialEnergyCertificate.energyConsumption !== 'undefined'"
             v-show="property.fields.residentialEnergyCertificate.type === 'consumption'"
        >
            <label class="form-label">{{ $t('Energy Consumption') }}</label>
            <input type="text" class="form-control" name="fields[residentialEnergyCertificate][energyConsumption]" v-model="property.fields.residentialEnergyCertificate.energyConsumption"
                   @click="showTooltip($t('help text example.'))"
                   @blur="hideTooltip()">
        </div>
        <div class="mb-3 col-md-6" v-if="typeof property.details.residentialEnergyCertificate.energySource !== 'undefined'">
            <label class="form-label">{{ $t('Energy Source') }}</label>
            <select class="form-control" name="fields[residentialEnergyCertificate][energySource]" v-model="property.fields.residentialEnergyCertificate.energySource">
                <option value="-1">{{ $t('Choose') }}</option>
                <option v-for="energySource in energySources" :value="energySource">{{ $t(energySource) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-6" v-if="typeof property.details.residentialEnergyCertificate.energyClass !== 'undefined'">
            <label class="form-label">{{ $t('Energy Class') }}</label>
            <select class="form-control" name="fields[residentialEnergyCertificate][energyClass]" v-model="property.fields.residentialEnergyCertificate.energyClass">
                <option value="-1">{{ $t('Choose') }}</option>
                <option v-for="energyClass in energyClasses" :value="energyClass">{{ $t(energyClass) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-6" v-if="typeof property.details.residentialEnergyCertificate.prior2014 !== 'undefined'">
            <label class="form-control">
                <input type="checkbox" class="form-check-input" name="fields[residentialEnergyCertificate][prior2014]" value="1" true-value="1" v-model="property.fields.residentialEnergyCertificate.prior2014">
                <span class="form-check-label">{{ $t('Prior 2014') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-6"
             v-if="typeof property.details.residentialEnergyCertificate.warmWaterIncluded !== 'undefined'"
             v-show="property.fields.residentialEnergyCertificate.prior2014"
        >
            <label class="form-control">
                <input type="checkbox" class="form-check-input" name="fields[residentialEnergyCertificate][warmWaterIncluded]" value="1" true-value="1" v-model="property.fields.residentialEnergyCertificate.warmWaterIncluded">
                <span class="form-check-label">{{ $t('Warm Water Included') }}</span>
            </label>
        </div>
    </div>

</template>
<script>

    export default {
        props: {
            property: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            residentialEnergyCertificateTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            energySources: {
                type: Array,
                default: function () {
                    return []
                }
            },
            energyClasses: {
                type: Array,
                default: function () {
                    return []
                }
            },
        },
        data() {
            return {
                propertyType: "kuca"
            };
        },
        methods: {
            showTooltip(text) {
                let tooltip = {
                    show: true,
                    text: $t(text),
                };
                EventBus.$emit('show-tooltip', tooltip);
                this.$emit('show-tooltip', tooltip);
            },
            hideTooltip() {
                let tooltip = {
                    show: false,
                    text: '',
                };
                EventBus.$emit('show-tooltip', tooltip);
                this.$emit('show-tooltip', tooltip);
            }
        }
    }
</script>