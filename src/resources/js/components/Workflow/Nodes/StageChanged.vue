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
        <span class="condition-box pe-2 justify-content-end">
            <span class="condition-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-refresh-cw align-middle"><polyline
                    points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path
                    d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span>
            Stage Changed</span>

        <Handle :id="`state.stage.changed.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleTarget" class="handle">
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
    }
}
</style>
