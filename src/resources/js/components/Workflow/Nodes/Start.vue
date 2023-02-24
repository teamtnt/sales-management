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
        bottom: '-6px'

    }));
</script>
<template>
    <div class="vue-flow__node-input shadow-sm">
        <span class="action-box pe-2 justify-content-center">
            <span class="action-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-clock align-middle">
                                <circle cx="12" cy="12" r="10"></circle><polyline
                    points="12 6 12 12 16 14"></polyline></svg>
            </span>
            Start
        </span>

        <Handle id="start" type="source" :position="Position.Bottom" :style="sourceHandleStyleTarget" class="handle">
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
