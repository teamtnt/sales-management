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
        <span class="start-box pe-2 justify-content-center">
            <span class="start-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
            </span>
            Start
        </span>

        <Handle id="start" type="source" :position="Position.Bottom" :style="sourceHandleStyleTarget" class="handle">
            <span class="circle"/>
        </Handle>

    </div>
</template>
