<template>
    <div :id="id">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ title }}</h5>
        </div>
        <div class="card-body">
            <slot></slot>
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
            id: {
                type: String,
                default: null
            },
        },
    }
</script>