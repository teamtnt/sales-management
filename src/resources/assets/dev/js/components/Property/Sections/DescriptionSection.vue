<template>
    <div class="row">
        <div class="mb-3 col-md-12" v-if="typeof property.details.description !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.description !== 'undefined') ? 'required':''">{{ $t('Object Description') }}</label>
            <textarea class="form-control" rows="5" name="fields[description]"
                      maxlength="3999"
                      :required="!!(typeof requiredFields.description !== 'undefined')"
                      v-model="property.fields.description"></textarea>
        </div>
        <div class="mb-3 col-md-12" v-if="typeof property.details.furnishingDescription !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.furnishingDescription !== 'undefined') ? 'required':''">{{ $t('Furnishing Description') }}</label>
            <textarea class="form-control" rows="5" name="fields[furnishingDescription]"
                      maxlength="3999"
                      :required="!!(typeof requiredFields.furnishingDescription !== 'undefined')"
                      v-model="property.fields.furnishingDescription"></textarea>
        </div>
        <div class="mb-3 col-md-12" v-if="typeof property.details.locationDescription !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.locationDescription !== 'undefined') ? 'required':''">{{ $t('Location Description') }}</label>
            <textarea class="form-control" rows="5" name="fields[locationDescription]"
                      maxlength="3999"
                      :required="!!(typeof requiredFields.locationDescription !== 'undefined')"
                      v-model="property.fields.locationDescription"></textarea>
        </div>
        <div class="mb-3 col-md-12" v-if="typeof property.details.commissionDescription !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.commissionDescription !== 'undefined') ? 'required':''">{{ $t('Commission Description') }}</label>
            <textarea class="form-control" rows="5" name="fields[commissionDescription]"
                      maxlength="1800"
                      :required="!!(typeof requiredFields.commissionDescription !== 'undefined')"
                      v-model="property.fields.commissionDescription"></textarea>
        </div>
        <div class="mb-3 col-md-12" v-if="typeof property.details.miscellaneousDescription !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.miscellaneousDescription !== 'undefined') ? 'required':''">{{ $t('Miscellaneous Description') }}</label>
            <textarea class="form-control" rows="5" name="fields[miscellaneousDescription]"
                      maxlength="3999"
                      :required="!!(typeof requiredFields.miscellaneousDescription !== 'undefined')"
                      v-model="property.fields.miscellaneousDescription"></textarea>
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
            requiredFields: {
                type: Object,
                default: function () {
                    return {}
                }
            },
        },
        data() {
            return {
                propertyType: "kuca"
            };
        },
    }
</script>