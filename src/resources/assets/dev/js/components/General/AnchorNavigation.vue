<template>
    <div class="card">
        <div v-if="title" class="card-header">
            <h5 class="card-title mb-0">{{ title }}</h5>
        </div>

        <div class="list-group list-group-flush ">
            <a v-for="link in links" class="list-group-item list-group-item-action"
               :class="link.active"
               :href="link.url"
            >
                {{ link.title }}
            </a>
        </div>
    </div>


</template>
<script>
    export default {
        props: {
            title: {
                type: String,
                default: null
            },
            links: {
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
    }
</script>
