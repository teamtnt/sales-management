<template>

    <h1>{{ $t('this should be translated to german') }}</h1>

    <div>Selected: {{ propertyType }}</div>

    <div class="row">
        <div class="col">
            <select class="form-control" v-model="propertyType">
                <option value="kuca">Kuca</option>
                <option value="stan">Stan</option>
            </select>
        </div>
        <div class="col">
            <kuca-property v-if="propertyType == 'kuca'"></kuca-property>
            <stan-property v-if="propertyType == 'stan'"></stan-property>
        </div>
    </div>

</template>
<script>
import KucaProperty from "./PropertieTypes/Kuca.vue";
import StanProperty from "./PropertieTypes/Stan.vue";

export default {
    components: {
        KucaProperty,
        StanProperty
    },

    data() {
        return {
            propertyType: "kuca"
        };
    },

    setup: () => ({
        title: 'This is an example component bok',
       
    })
}
</script>