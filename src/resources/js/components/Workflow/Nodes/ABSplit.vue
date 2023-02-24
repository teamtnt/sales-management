<script setup>
    import {Handle, Position} from '@vue-flow/core'
    import { computed } from "vue";

    const props = defineProps({
        id: String,
        label: String,
        type: String
    })

    const sourceHandleStyleTarget = computed(() => ({
        backgroundColor: 'white',
        borderColor: '#dcdbdb',
        borderStyle: 'solid',
        borderWidth: '1px',
        width: '14px',
        height: '14px',
        top: '-7px'

    }));
    const sourceHandleStyleOpened = computed(() => ({
        backgroundColor: 'white',
        borderColor: '#dcdbdb',
        borderStyle: 'solid',
        borderWidth: '1px',
        width: '14px',
        height: '14px',
        left: '48px',
        right: 'auto',
        bottom: '-7px'

    }));
    const sourceHandleStyleNotOpened = computed(() => ({
        backgroundColor: 'white',
        borderColor: '#dcdbdb',
        borderStyle: 'solid',
        borderWidth: '1px',
        width: '14px',
        height: '14px',
        right: '40px',
        left: 'auto',
        bottom: '-7px'

    }));
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

        <Handle :id="`state.message.opened.target.${id}`" type="target" :position="Position.Top" :style="sourceHandleStyleTarget" class="handle">
            <span class="circle"/>
        </Handle>

        <Handle :id="`state.message.opened.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleOpened" class="handle">
            <span class="circle"/>
        </Handle>
        <Handle :id="`state.message.not_opened.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleNotOpened" class="handle">
            <span class="circle"/>
        </Handle>
    </div>
</template>

<style scoped lang="scss">
.handle {
    display: flex;
    align-items: center;
    justify-content: center;

    .circle {
        display: block;
        position: absolute;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background-color: gray;
        pointer-events: none;
    }
}
</style>
