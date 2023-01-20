<template>
    <div class="row">
        <div class="mb-3 col-md-12">
            <label class="form-label required">{{ $t('Title') }}</label>
            <input type="text" class="form-control" name="title" v-model="property.title" required
                   @click="showTooltip($t('Short description of the listed property. Used by many platforms as heading.'))"
                   @blur="hideTooltip()">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label required">{{ $t('Street') }}</label>
            <input type="text" class="form-control" name="address[street]" v-model="address.street" required>
        </div>
        <div class="mb-3 col-md-2">
            <label class="form-label required">{{ $t('House number') }}</label>
            <input type="text" class="form-control" name="address[house_number]" v-model="address.house_number" required>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label">{{ $t('Publish') }}</label>
            <label class="form-control">
                <input type="checkbox" class="form-check-input" name="address[publish]" value="1" true-value="1"
                       v-model="address.publish"
                       @click="showTooltip($t('If the street address should be published, just check this.'))"
                       @blur="hideTooltip()">
                <span class="form-check-label">{{ $t('Publish street name and house number') }}</span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-2">
            <label class="form-label required">{{ $t('Postal code') }}</label>
            <input type="text" class="form-control" name="address[postal_code]" v-model="address.postal_code" required>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label required">{{ $t('City') }}</label>
            <input type="text" class="form-control" name="address[city]" v-model="address.city" required>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label required">{{ $t('Country') }}</label>
            <select class="form-control" name="address[country_id]" v-model="address.country_id" required>
                <option v-for="country in countries" :value="country.id">{{ $t(country.name) }}</option>
            </select>
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col-md-4" v-if="typeof property.details.numberOfRooms !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.numberOfRooms !== 'undefined') ? 'required':''">{{ $t('Number of rooms') }}</label>
            <input type="number" class="form-control" name="fields[numberOfRooms]"
                   v-model="property.fields.numberOfRooms"
                   :required="!!(typeof requiredFields.numberOfRooms !== 'undefined')"
                   min="0" max="999"
                   @click="showTooltip($t('The number of rooms the property has.'))"
                   @blur="hideTooltip()">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.livingArea !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.livingArea !== 'undefined') ? 'required':''">{{ $t('Living area') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[livingArea]"
                       v-model="property.fields.livingArea"
                       :required="!!(typeof requiredFields.livingArea !== 'undefined')"
                       min="0" max="99999999" step="0.01"
                       @click="showTooltip($t('The living area of the property according to DIN 277.'))"
                       @blur="hideTooltip()"
                       required>
                <span class="input-group-text">m2</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.plotArea !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.plotArea !== 'undefined') ? 'required':''">{{ $t('Plot area') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[plotArea]"
                       v-model="property.fields.plotArea"
                       :required="!!(typeof requiredFields.plotArea !== 'undefined')"
                       min="0" max="99999999" step="0.01"
                       @click="showTooltip($t('The plot area of the property according to DIN 277.'))"
                       @blur="hideTooltip()"
                       required>
                <span class="input-group-text">m2</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.usableArea !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.usableArea !== 'undefined') ? 'required':''">{{ $t('Usable area') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[usableArea]"
                       v-model="property.fields.usableArea"
                       :required="!!(typeof requiredFields.usableArea !== 'undefined')"
                       min="0" max="99999999" step="0.01"
                       @click="showTooltip($t('The area of the property that is usable according to DIN 277.'))"
                       @blur="hideTooltip()"
                       required>
                <span class="input-group-text">m2</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.totalArea !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.totalArea !== 'undefined') ? 'required':''">{{ $t('Total area') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[totalArea]"
                       v-model="property.fields.totalArea"
                       :required="!!(typeof requiredFields.totalArea !== 'undefined')"
                       min="0" max="99999999" step="0.01"
                       @click="showTooltip($t('The total area of the property according to DIN 277.'))"
                       @blur="hideTooltip()"
                       required>
                <span class="input-group-text">m2</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.parkingArea !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.parkingArea !== 'undefined') ? 'required':''">{{ $t('Parking area') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[parkingArea]"
                       v-model="property.fields.parkingArea"
                       :required="!!(typeof requiredFields.parkingArea !== 'undefined')"
                       min="0" max="99"
                       @click="showTooltip($t('The area of one parking space on the property.'))"
                       @blur="hideTooltip()">
                <span class="input-group-text">m2</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.rentableArea !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.rentableArea !== 'undefined') ? 'required':''">{{ $t('Rentable area') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[rentableArea]"
                       v-model="property.fields.rentableArea"
                       :required="!!(typeof requiredFields.rentableArea !== 'undefined')"
                       min="0" max="99999999" step="0.01"
                       @click="showTooltip($t('The rentable area of the property according to DIN 277.'))"
                       @blur="hideTooltip()"
                       required>
                <span class="input-group-text">m2</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.purchasePriceOnRequest !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.purchasePriceOnRequest !== 'undefined') ? 'required':''">{{ $t('Purchase Price') }}</label>
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the price for the property is given only on request.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[purchasePriceOnRequest]" value="1" true-value="1" v-model="property.fields.purchasePriceOnRequest">
                <span class="form-check-label">{{ $t('Purchase Price On Request') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.purchasePrice !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.purchasePrice !== 'undefined') ? 'required':''">{{ $t('Purchase Price') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[purchasePrice]"
                       v-model="property.fields.purchasePrice"
                       :required="!!(typeof requiredFields.purchasePrice !== 'undefined')"
                       min="0" max="9999999999999" step="0.01"
                       @click="showTooltip($t('The price offered to purchase the property.'))"
                       @blur="hideTooltip()">
                <span class="input-group-text">€</span>
            </div>
        </div>

        <div class="mb-3 col-md-3" v-if="typeof property.details.rentOnRequest !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the rent is given only on request.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[rentOnRequest]" value="1" true-value="1" v-model="property.fields.rentOnRequest">
                <span class="form-check-label">{{ $t('Rent On Request') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.rentPerSqm !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the given rent is for one squaremeter and not the whole property.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[rentPerSqm]" value="1" true-value="1" v-model="property.fields.rentPerSqm">
                <span class="form-check-label">{{ $t('Rent Per Sqm') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.rent !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.rent !== 'undefined') ? 'required':''">{{ $t('Rent') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[rent]"
                       v-model="property.fields.rent"
                       :required="!!(typeof requiredFields.rent !== 'undefined')"
                       min="0" max="99999999" step="0.01"
                       @click="showTooltip($t('The price offered to purchase the property.'))"
                       @blur="hideTooltip()">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.baseRent !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.baseRent !== 'undefined') ? 'required':''">{{ $t('Base Rent') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[baseRent]"
                       v-model="property.fields.baseRent"
                       :required="!!(typeof requiredFields.baseRent !== 'undefined')"
                       min="0" max="9999999999999" step="0.01"
                       @click="showTooltip($t('The base rent of the property, often called Cold Rent in Germany.'))"
                       @blur="hideTooltip()">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.totalRent !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.totalRent !== 'undefined') ? 'required':''">{{ $t('Total Rent') }}</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="fields[totalRent]"
                       v-model="property.fields.totalRent"
                       :required="!!(typeof requiredFields.totalRent !== 'undefined')"
                       min="0" max="9999999999999" step="0.01"
                       @click="showTooltip($t('The total rent of the property, sometimes called Warm Rent in Germany.'))"
                       @blur="hideTooltip()">
                <span class="input-group-text">€</span>
            </div>
        </div>

    </div>
</template>
<script>

    export default {
        props: {
            addressData: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            countries: {
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
            requiredFields: {
                type: Object,
                default: function () {
                    return {}
                }
            },
        },
        data() {
            return {
                address: this.property.address
            };
        },
        methods: {
            showTooltip(text) {
                let tooltip = {
                    show: true,
                    text: text,
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
