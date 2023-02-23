<script setup>
    import {Handle, Position} from '@vue-flow/core'

    const props = defineProps({
        id: String,
        label: String,
        type: String
    })
</script>

<template>
    <div class="vue-flow__node-input shadow-sm">
        <span class="condition-box pe-2 justify-content-end">
            <span class="condition-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-refresh-cw align-middle"><polyline
                    points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path
                    d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span>
            Message Opened</span>

        <Handle :id="`state.message.opened.target.${id}`" type="target" :position="Position.Top"/>

        <Handle :id="`state.message.opened.${id}`" type="source" :position="Position.Bottom" class="bottom-left"/>
        <Handle :id="`state.message.not_opened.${id}`" type="source" :position="Position.Bottom" class="bottom-right"/>
    </div>
</template>


<style lang="scss">
.bottom-left {
    left: 40px;
    background-color: green;
    border-color: green;
}

.bottom-right {
    right: 40px;
    background-color: red;
    border-color: red;
}
</style>
