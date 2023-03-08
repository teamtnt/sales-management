<script setup>
    import {Handle, Position} from '@vue-flow/core'
    import {computed} from "vue";

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
            <span class="condition-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
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
