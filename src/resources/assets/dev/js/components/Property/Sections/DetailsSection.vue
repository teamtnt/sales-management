<template>
    <div class="row">
        <div class="mb-3 col-md-3" v-if="typeof property.details.isSuitableAsSharedFlat !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property is suitable as shared flat.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input"
                       name="fields[isSuitableAsSharedFlat]" value="1" true-value="1"
                       v-model="property.fields.isSuitableAsSharedFlat"
                >
                <span class="form-check-label">{{ $t('Is Suitable As Shared Flat') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.isAccessible !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property is accessible.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input"
                       name="fields[isAccessible]" value="1" true-value="1"
                       v-model="property.fields.isAccessible"
                >
                <span class="form-check-label">{{ $t('Is Accessible') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasLift !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a lift.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasLift]" value="1" true-value="1" v-model="property.fields.hasLift">
                <span class="form-check-label">{{ $t('Has Lift') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasGuestToilet !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a guest toilet.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasGuestToilet]" value="1" true-value="1" v-model="property.fields.hasGuestToilet">
                <span class="form-check-label">{{ $t('Has Guest Toilet') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasGarden !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a garden.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasGarden]" value="1" true-value="1" v-model="property.fields.hasGarden">
                <span class="form-check-label">{{ $t('Has Garden') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasCellar !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a cellar.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasCellar]" value="1" true-value="1" v-model="property.fields.hasCellar">
                <span class="form-check-label">{{ $t('Has Cellar') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasBuiltInKitchen !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a built in kitchen. Usually for apartments.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasBuiltInKitchen]" value="1" true-value="1" v-model="property.fields.hasBuiltInKitchen">
                <span class="form-check-label">{{ $t('Has BuiltIn Kitchen') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasBalcony !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a balcony.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasBalcony]" value="1" true-value="1" v-model="property.fields.hasBalcony">
                <span class="form-check-label">{{ $t('Has Balcony') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.petsAllowed !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if pets are allowed.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[petsAllowed]" value="1" true-value="1" v-model="property.fields.petsAllowed">
                <span class="form-check-label">{{ $t('Pets Allowed') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.requiresWBS !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property requires a \'Wohnberechtigungsschein\' (short \'WBS\') - a certificate that declares the eligibility for subsidized living.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[requiresWBS]" value="1" true-value="1" v-model="property.fields.requiresWBS">
                <span class="form-check-label">{{ $t('Requires WBS') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.isListed !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property is listed as protected historic building.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[isListed]" value="1" true-value="1" v-model="property.fields.isListed">
                <span class="form-check-label">{{ $t('Is Listed') }}</span>
            </label>
        </div>

        <div class="mb-3 col-md-3" v-if="typeof property.details.isRented !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property is currently rented.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[isRented]" value="1" true-value="1" v-model="property.fields.isRented">
                <span class="form-check-label">{{ $t('Is Rented') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.isSuitableAsHolidayHome !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property is suitable to be used as holiday home.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[isSuitableAsHolidayHome]" value="1" true-value="1" v-model="property.fields.isSuitableAsHolidayHome">
                <span class="form-check-label">{{ $t('Is Suitable As Holiday Home') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasLodgerFlat !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a lodger flat.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasLodgerFlat]" value="1" true-value="1" v-model="property.fields.hasLodgerFlat">
                <span class="form-check-label">{{ $t('Has Lodger Flat') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasAirConditioning !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has air conditioning.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasAirConditioning]" value="1" true-value="1" v-model="property.fields.hasAirConditioning">
                <span class="form-check-label">{{ $t('Has AirConditioning') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasCanteen !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a canteen.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasCanteen]" value="1" true-value="1" v-model="property.fields.hasCanteen">
                <span class="form-check-label">{{ $t('Has Canteen') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasKitchen !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a kitchen. Usually for commercial properties.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasKitchen]" value="1" true-value="1" v-model="property.fields.hasKitchen">
                <span class="form-check-label">{{ $t('Has Kitchen') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasNetworkCables !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has network cables installed.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasNetworkCables]" value="1" true-value="1" v-model="property.fields.hasNetworkCables">
                <span class="form-check-label">{{ $t('Has Network Cables') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasTerrace !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a guest terrace.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasTerrace]" value="1" true-value="1" v-model="property.fields.hasTerrace">
                <span class="form-check-label">{{ $t('Has Terrace') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.hasRamp !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the property has a ramp for eg. unloading trucks.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[hasRamp]" value="1" true-value="1" v-model="property.fields.hasRamp">
                <span class="form-check-label">{{ $t('Has Ramp') }}</span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-4" v-if="typeof property.details.parkingSpaceRent !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.parkingSpaceRent !== 'undefined') ? 'required':''">{{ $t('Parking Space Rent') }}</label>
            <div class="input-group mb-4">
                <input @click="showTooltip($t('Rent price of the parking spaces that are available.'))"
                       @blur="hideTooltip()" type="number" class="form-control" name="fields[parkingSpaceRent]"
                       v-model="property.fields.parkingSpaceRent"
                       min="0" max="9999999999999" step="0.01"
                       :required="!!(typeof requiredFields.parkingSpaceRent !== 'undefined')">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.parkingSpacePurchasePrice !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.parkingSpacePurchasePrice !== 'undefined') ? 'required':''">{{ $t('Parking Space Purchase Price') }}</label>
            <div class="input-group mb-4">
                <input @click="showTooltip($t('Purchase price of the parking spaces that are available.'))"
                       @blur="hideTooltip()" type="number" class="form-control" name="fields[parkingSpacePurchasePrice]"
                       v-model="property.fields.parkingSpacePurchasePrice"
                       min="0" max="9999999999999" step="0.01"
                       :required="!!(typeof requiredFields.parkingSpacePurchasePrice !== 'undefined')">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.numberOfParkingSpaces !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.numberOfParkingSpaces !== 'undefined') ? 'required':''">{{ $t('Number Of Parking Spaces') }}</label>
            <input @click="showTooltip($t('Number of parking spaces that are available.'))"
                   @blur="hideTooltip()" type="number" class="form-control" name="fields[numberOfParkingSpaces]"
                   v-model="property.fields.numberOfParkingSpaces"
                   min="0" max="99999"
                   :required="!!(typeof requiredFields.numberOfParkingSpaces !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.parkingSpaceType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.parkingSpaceType !== 'undefined') ? 'required':''">{{ $t('Parking Space Type') }}</label>
            <select class="form-control" name="fields[parkingSpaceType]"
                    v-model="property.fields.parkingSpaceType"
                    :required="!!(typeof requiredFields.parkingSpaceType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.parkingSpaceType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="parkingSpaceType in parkingSpaceTypes" :value="parkingSpaceType">{{ $t(parkingSpaceType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.interiorQuality !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.interiorQuality !== 'undefined') ? 'required':''">{{ $t('Interior Quality') }}</label>
            <select class="form-control" name="fields[interiorQuality]"
                    v-model="property.fields.interiorQuality"
                    :required="!!(typeof requiredFields.interiorQuality !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.interiorQuality === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="interiorQuality in interiorQualities" :value="interiorQuality">{{ $t(interiorQuality) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.heatingType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.heatingType !== 'undefined') ? 'required':''">{{ $t('Heating Type') }}</label>
            <select class="form-control" name="fields[heatingType]"
                    v-model="property.fields.heatingType"
                    :required="!!(typeof requiredFields.heatingType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.heatingType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="heatingType in heatingTypes" :value="heatingType">{{ $t(heatingType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.energyCertificateStatus !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.energyCertificateStatus !== 'undefined') ? 'required':''">{{ $t('Energy Certificate Status') }}</label>
            <select class="form-control" name="fields[energyCertificateStatus]"
                    v-model="property.fields.energyCertificateStatus"
                    :required="!!(typeof requiredFields.energyCertificateStatus !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.energyCertificateStatus === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="energyCertificateStatus in energyCertificateStatuses" :value="energyCertificateStatus">{{ $t(energyCertificateStatus) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.condition !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.condition !== 'undefined') ? 'required':''">{{ $t('Condition') }}</label>
            <select class="form-control" name="fields[condition]"
                    v-model="property.fields.condition"
                    :required="!!(typeof requiredFields.condition !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.condition === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="condition in conditions" :value="condition">{{ $t(condition) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.apartmentType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.apartmentType !== 'undefined') ? 'required':''">{{ $t('Apartment Type') }}</label>
            <select class="form-control" name="fields[apartmentType]"
                    v-model="property.fields.apartmentType"
                    :required="!!(typeof requiredFields.apartmentType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.apartmentType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="apartmentType in apartmentTypes" :value="apartmentType">{{ $t(apartmentType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.houseType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.houseType !== 'undefined') ? 'required':''">{{ $t('House Type') }}</label>
            <select class="form-control" name="fields[houseType]"
                    v-model="property.fields.houseType"
                    :required="!!(typeof requiredFields.houseType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.houseType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="houseType in houseTypes" :value="houseType">{{ $t(houseType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.buildingRegulation !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.buildingRegulation !== 'undefined') ? 'required':''">{{ $t('Building Regulations') }}</label>
            <select class="form-control" name="fields[buildingRegulation]"
                    v-model="property.fields.buildingRegulation"
                    :required="!!(typeof requiredFields.buildingRegulation !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.buildingRegulation === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="buildingRegulation in buildingRegulations" :value="buildingRegulation">{{ $t(buildingRegulation) }}</option>
            </select>
        </div>

        <div class="mb-3 col-md-4" v-if="typeof property.details.development !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.development !== 'undefined') ? 'required':''">{{ $t('Development') }}</label>
            <select class="form-control" name="fields[development]"
                    v-model="property.fields.development"
                    :required="!!(typeof requiredFields.development !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.development === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="development in developments" :value="development">{{ $t(development) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.flooringType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.flooringType !== 'undefined') ? 'required':''">{{ $t('Flooring Type') }}</label>
            <select class="form-control" name="fields[flooringType]"
                    v-model="property.fields.flooringType"
                    :required="!!(typeof requiredFields.flooringType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.flooringType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="flooringType in flooringTypes" :value="flooringType">{{ $t(flooringType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.officeType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.officeType !== 'undefined') ? 'required':''">{{ $t('Office Type') }} *</label>
            <select class="form-control" name="fields[officeType]"
                    v-model="property.fields.officeType"
                    :required="!!(typeof requiredFields.officeType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.officeType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="officeType in officeTypes" :value="officeType">{{ $t(officeType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.gastronomyType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.gastronomyType !== 'undefined') ? 'required':''">{{ $t('Gastronomy Type') }}</label>
            <select class="form-control" name="fields[gastronomyType]"
                    v-model="property.fields.gastronomyType"
                    :required="!!(typeof requiredFields.gastronomyType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.gastronomyType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="gastronomyType in gastronomyTypes" :value="gastronomyType">{{ $t(gastronomyType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.retailType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.retailType !== 'undefined') ? 'required':''">{{ $t('Retail Type') }}</label>
            <select class="form-control" name="fields[retailType]"
                    v-model="property.fields.retailType"
                    :required="!!(typeof requiredFields.retailType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.retailType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="retailType in retailTypes" :value="retailType">{{ $t(retailType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.industrialType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.industrialType !== 'undefined') ? 'required':''">{{ $t('Industrial Type') }}</label>
            <select class="form-control" name="fields[industrialType]"
                    v-model="property.fields.industrialType"
                    :required="!!(typeof requiredFields.industrialType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.industrialType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="industrialType in industrialTypes" :value="industrialType">{{ $t(industrialType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.commercialPlotType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.commercialPlotType !== 'undefined') ? 'required':''">{{ $t('Commercial Plot Type') }}</label>
            <select class="form-control" name="fields[commercialPlotType]"
                    v-model="property.fields.commercialPlotType"
                    :required="!!(typeof requiredFields.commercialPlotType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.commercialPlotType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="commercialPlotType in commercialPlotTypes" :value="commercialPlotType">{{ $t(commercialPlotType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.residentialInvestmentType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.residentialInvestmentType !== 'undefined') ? 'required':''">{{ $t('Residential Investment Type') }}</label>
            <select class="form-control" name="fields[residentialInvestmentType]"
                    v-model="property.fields.residentialInvestmentType"
                    :required="!!(typeof requiredFields.residentialInvestmentType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.residentialInvestmentType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="residentialInvestmentType in residentialInvestmentTypes" :value="residentialInvestmentType">{{ $t(residentialInvestmentType) }}</option>
            </select>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.commercialInvestmentType !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.commercialInvestmentType !== 'undefined') ? 'required':''">{{ $t('Commercial Investment Type') }}</label>
            <select class="form-control" name="fields[commercialInvestmentType]"
                    v-model="property.fields.commercialInvestmentType"
                    :required="!!(typeof requiredFields.commercialInvestmentType !== 'undefined')">
                <option value="" v-if="typeof  requiredFields.commercialInvestmentType === 'undefined'">{{ $t('Choose') }}</option>
                <option v-for="commercialInvestmentType in commercialInvestmentTypes" :value="commercialInvestmentType">{{ $t(commercialInvestmentType) }}</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-4" v-if="typeof property.details.additionalCosts !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.additionalCosts !== 'undefined') ? 'required':''">{{ $t('Additional Costs') }}</label>
            <div class="input-group mb-3">
                <input @click="showTooltip($t('The additional costs of the property.'))"
                       @blur="hideTooltip()" type="number" class="form-control" name="fields[additionalCosts]"
                       v-model="property.fields.additionalCosts"
                       min="0" max="9999999999999" step="0.01"
                       :required="!!(typeof requiredFields.additionalCosts !== 'undefined')">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mb-3 col-md-3" v-if="typeof property.details.additionalCostsIncludeHeatingCosts !== 'undefined'">
            <label class="form-control">
                <input @click="showTooltip($t('Indicates if the heating costs are included in the additional costs.'))"
                       @blur="hideTooltip()" type="checkbox" class="form-check-input" name="fields[additionalCostsIncludeHeatingCosts]" value="1" true-value="1" v-model="property.fields.additionalCostsIncludeHeatingCosts">
                <span class="form-check-label">{{ $t('Additional Costs Include Heating Costs') }}</span>
            </label>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.deposit !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.deposit !== 'undefined') ? 'required':''">{{ $t('Deposit') }}</label>
            <div class="input-group mb-3">
                <input @click="showTooltip($t('The deposit required for this property.'))"
                       @blur="hideTooltip()" type="text" class="form-control" name="fields[deposit]"
                       v-model="property.fields.deposit"
                       maxlength="50"
                       :required="!!(typeof requiredFields.deposit !== 'undefined')">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.heatingCosts !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.heatingCosts !== 'undefined') ? 'required':''">{{ $t('Heating Costs') }}</label>
            <div class="input-group mb-3">
                <input @click="showTooltip($t('The heating costs of the property.'))"
                       @blur="hideTooltip()" type="number" class="form-control" name="fields[heatingCosts]"
                       v-model="property.fields.heatingCosts"
                       min="0" max="9999999999999" step="0.01"
                       :required="!!(typeof requiredFields.heatingCosts !== 'undefined')">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.availableFrom !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.availableFrom !== 'undefined') ? 'required':''">{{ $t('Available From') }}</label>
            <input @click="showTooltip($t('From when the property will be available.'))"
                   @blur="hideTooltip()"
                   type="date" class="form-control" name="fields[availableFrom]"
                   v-model="property.fields.availableFrom"
                   :required="!!(typeof requiredFields.availableFrom !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.commission !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.commission !== 'undefined') ? 'required':''">{{ $t('Commission') }}</label>
            <input @click="showTooltip($t('The commission the property is marketed with. This should always include VAT to comply with the German PAngV regulation. Leave out if there is no commission.'))"
                   @blur="hideTooltip()"
                   type="text" class="form-control" name="fields[commission]"
                   maxlength="100"
                   v-model="property.fields.commission"
                   :required="!!(typeof requiredFields.commission !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.floorSpaceIndex !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.floorSpaceIndex !== 'undefined') ? 'required':''">{{ $t('Floor Space Index') }}</label>
            <input @click="showTooltip($t('In German law \'Geschossflächenzahl\' according to §20 BauNVO.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[floorSpaceIndex]"
                   min="0" max="9" step="0.01"
                   v-model="property.fields.floorSpaceIndex"
                   :required="!!(typeof requiredFields.floorSpaceIndex !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.siteCoverageIndex !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.siteCoverageIndex !== 'undefined') ? 'required':''">{{ $t('siteCoverageIndex') }}</label>
            <input @click="showTooltip($t('In German law \'Grundflächenzahl\' according to §19 BauNVO. Defines on how much of the plot area one can build.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[siteCoverageIndex]"
                   v-model="property.fields.siteCoverageIndex"
                   min="0" max="9" step="0.01"
                   :required="!!(typeof requiredFields.siteCoverageIndex !== 'undefined')">
        </div>

        <div class="mb-3 col-md-4" v-if="typeof property.details.divisibleFrom !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.divisibleFrom !== 'undefined') ? 'required':''">{{ $t('Divisible From') }}</label>
            <input @click="showTooltip($t('From this area on the property can be divided.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[divisibleFrom]"
                   v-model="property.fields.divisibleFrom"
                   min="0" max="9999999" step="0.01"
                   :required="!!(typeof requiredFields.divisibleFrom !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.constructionYear !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.constructionYear !== 'undefined') ? 'required':''">{{ $t('Construction Year') }}</label>
            <input @click="showTooltip($t('The year the property was constructed. If there is an energy certificate this should be filled out.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[constructionYear]"
                   v-model="property.fields.constructionYear"
                   min="1000" max="9999"
                   :required="!!(typeof requiredFields.constructionYear !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.lastRefurbished !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.lastRefurbished !== 'undefined') ? 'required':''">{{ $t('Last Refurbished') }}</label>
            <input @click="showTooltip($t('The year the property was last refurbished.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[lastRefurbished]"
                   v-model="property.fields.lastRefurbished"
                   min="1000" max="9999"
                   :required="!!(typeof requiredFields.lastRefurbished !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.floor !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.floor !== 'undefined') ? 'required':''">{{ $t('Floor') }}</label>
            <input @click="showTooltip($t('Number of the floor the property is situated on.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[floor]"
                   v-model="property.fields.floor"
                   min="-1" max="999"
                   :required="!!(typeof requiredFields.floor !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.numberOfBathrooms !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.numberOfBathrooms !== 'undefined') ? 'required':''">{{ $t('Number Of Bathrooms') }}</label>
            <input @click="showTooltip($t('The number of bathrooms the property has.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[numberOfBathrooms]"
                   v-model="property.fields.numberOfBathrooms"
                   min="0" max="99"
                   :required="!!(typeof requiredFields.numberOfBathrooms !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.numberOfBedrooms !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.numberOfBedrooms !== 'undefined') ? 'required':''">{{ $t('Number Of Bedrooms') }}</label>
            <input @click="showTooltip($t('The number of bedrooms the property has.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[numberOfBedrooms]"
                   v-model="property.fields.numberOfBedrooms"
                   min="0" max="99"
                   :required="!!(typeof requiredFields.numberOfBedrooms !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.numberOfBeds !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.numberOfBeds !== 'undefined') ? 'required':''">{{ $t('Number Of Beds') }}</label>
            <input @click="showTooltip($t('The number of available beds the property has. Usually for gastronomies.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[numberOfBeds]"
                   v-model="property.fields.numberOfBeds"
                   min="0" max="99"
                   :required="!!(typeof requiredFields.numberOfBeds !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.numberOfSeats !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.numberOfSeats !== 'undefined') ? 'required':''">{{ $t('Number Of Seats') }}</label>
            <input @click="showTooltip($t('The number of available seats the property has. Usually for gastronomies.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[numberOfSeats]"
                   v-model="property.fields.numberOfSeats"
                   min="0" max="99"
                   :required="!!(typeof requiredFields.numberOfSeats !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.numberOfFloors !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.numberOfFloors !== 'undefined') ? 'required':''">{{ $t('Number Of Floors') }}</label>
            <input @click="showTooltip($t('The number of floors the property has.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[numberOfFloors]"
                   v-model="property.fields.numberOfFloors"
                   min="0" max="99"
                   :required="!!(typeof requiredFields.numberOfFloors !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.condoFee !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.condoFee !== 'undefined') ? 'required':''">{{ $t('condoFee') }}</label>
            <input @click="showTooltip($t('condoFee'))"
                   @blur="hideTooltip()"
                   type="text" class="form-control" name="fields[condoFee]"
                   v-model="property.fields.condoFee"
                   :required="!!(typeof requiredFields.condoFee !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.monthlyRentalIncome !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.monthlyRentalIncome !== 'undefined') ? 'required':''">{{ $t('Monthly Rental Income') }}</label>
            <input @click="showTooltip($t('The monthly rent that is currently paid for the property.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[monthlyRentalIncome]"
                   v-model="property.fields.monthlyRentalIncome"
                   min="0" max="9999999999999" step="0.01"
                   :required="!!(typeof requiredFields.monthlyRentalIncome !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.drivingTimeToAirport !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.drivingTimeToAirport !== 'undefined') ? 'required':''">{{ $t('Driving Time To Airport') }}</label>
            <input @click="showTooltip($t('Number of minutes it takes to drive to the nearest airport.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[drivingTimeToAirport]"
                   v-model="property.fields.drivingTimeToAirport"
                   min="0" max="999"
                   :required="!!(typeof requiredFields.drivingTimeToAirport !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.drivingTimeToTrainStation !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.drivingTimeToTrainStation !== 'undefined') ? 'required':''">{{ $t('Driving Time To Train Station') }}</label>
            <input @click="showTooltip($t('Number of minutes it takes to drive to the nearest train station.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[drivingTimeToTrainStation]"
                   v-model="property.fields.drivingTimeToTrainStation"
                   min="0" max="999"
                   :required="!!(typeof requiredFields.drivingTimeToTrainStation !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.walkingTimeToPrivateTransit !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.walkingTimeToPrivateTransit !== 'undefined') ? 'required':''">{{ $t('Walking Time To Private Transit') }}</label>
            <input @click="showTooltip($t('Number of minutes it takes to walk to the private transit access point.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[walkingTimeToPrivateTransit]"
                   v-model="property.fields.walkingTimeToPrivateTransit"
                   min="0" max="999"
                   :required="!!(typeof requiredFields.walkingTimeToPrivateTransit !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.walkingTimeToPublicTransit !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.walkingTimeToPublicTransit !== 'undefined') ? 'required':''">{{ $t('Walking Time To Public Transit') }}</label>
            <input @click="showTooltip($t('Number of minutes it takes to walk to the nearest public transit access point.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[walkingTimeToPublicTransit]"
                   v-model="property.fields.walkingTimeToPublicTransit"
                   min="0" max="999"
                   :required="!!(typeof requiredFields.walkingTimeToPublicTransit !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.hallHeight !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.hallHeight !== 'undefined') ? 'required':''">{{ $t('Hall Height') }}</label>
            <input @click="showTooltip($t('The hall height the property has in meters. Mostly relevant for industrial properties.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[hallHeight]"
                   v-model="property.fields.hallHeight"
                   min="0" max="999" step="0.01"
                   :required="!!(typeof requiredFields.hallHeight !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.actualYearlyRentalIncome !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.actualYearlyRentalIncome !== 'undefined') ? 'required':''">{{ $t('Actual Yearly Rental Income') }}</label>
            <input @click="showTooltip($t('The yearly rent that is actually being paid for the property.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[actualYearlyRentalIncome]"
                   v-model="property.fields.actualYearlyRentalIncome"
                   min="0" max="9999999999999" step="0.01"
                   :required="!!(typeof requiredFields.actualYearlyRentalIncome !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.targetYearlyRentalIncome !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.targetYearlyRentalIncome !== 'undefined') ? 'required':''">{{ $t('Target Yearly Rental Income') }}</label>
            <input @click="showTooltip($t('The yearly rent that is targeted for the property.'))"
                   @blur="hideTooltip()"
                   type="number" class="form-control" name="fields[targetYearlyRentalIncome]"
                   v-model="property.fields.targetYearlyRentalIncome"
                   min="0" max="9999999999999" step="0.01"
                   :required="!!(typeof requiredFields.targetYearlyRentalIncome !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.freeFrom !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.freeFrom !== 'undefined') ? 'required':''">{{ $t('Free From') }}</label>
            <input @click="showTooltip($t('From when the property will be available.'))"
                   @blur="hideTooltip()"
                   type="date" class="form-control" name="fields[freeFrom]"
                   v-model="property.fields.freeFrom"
                   :required="!!(typeof requiredFields.freeFrom !== 'undefined')">
        </div>
        <div class="mb-3 col-md-4" v-if="typeof property.details.freeUntil !== 'undefined'">
            <label class="form-label" :class="(typeof requiredFields.freeUntil !== 'undefined') ? 'required':''">{{ $t('Free Until') }}</label>
            <input @click="showTooltip($t('Until when the property will be available.'))"
                   @blur="hideTooltip()"
                   type="date" class="form-control" name="fields[freeUntil]"
                   v-model="property.fields.freeUntil"
                   :required="!!(typeof requiredFields.freeUntil !== 'undefined')">
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
            interiorQualities: {
                type: Array,
                default: function () {
                    return []
                }
            },
            apartmentTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            energyCertificateStatuses: {
                type: Array,
                default: function () {
                    return []
                }
            },
            conditions: {
                type: Array,
                default: function () {
                    return []
                }
            },
            parkingSpaceTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            heatingTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            houseTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            buildingRegulations: {
                type: Array,
                default: function () {
                    return []
                }
            },
            developments: {
                type: Array,
                default: function () {
                    return []
                }
            },
            flooringTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            officeTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            gastronomyTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            retailTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            industrialTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            commercialPlotTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            residentialInvestmentTypes: {
                type: Array,
                default: function () {
                    return []
                }
            },
            commercialInvestmentTypes: {
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
