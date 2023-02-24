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
        <span class="action-box ps-2 justify-content-center">
            <span class="action-box__icon">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                    <line x1="12" y1="16" x2="12" y2="16"></line>
                    <line x1="12" y1="8" x2="12" y2="8"></line>
                </svg>
            </span>
            A/B Split
        </span>

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
