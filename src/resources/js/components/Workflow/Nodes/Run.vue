<script setup>
    import {Handle, Position, useVueFlow} from '@vue-flow/core'
    import {computed, ref} from "vue";
    import {NodeToolbar} from '@vue-flow/node-toolbar'

    const props = defineProps({
        id: String,
        label: String,
        type: String
    })

    const sourceHandleStyleTargetTop = computed(() => ({
        backgroundColor: 'white',
        borderColor: '#dcdbdb',
        borderStyle: 'solid',
        borderWidth: '1px',
        width: '14px',
        height: '14px',
        top: '-7px'

    }));
    const sourceHandleStyleTargetBottom = computed(() => ({
        backgroundColor: 'white',
        borderColor: '#dcdbdb',
        borderStyle: 'solid',
        borderWidth: '1px',
        width: '14px',
        height: '14px',
        bottom: '-7px'

    }));
 
    const {findNode} = useVueFlow()
    const node = ref(findNode(props.id));
    node.value.data = {
        "argument": window.workflowId,
    }
</script>

<template>
    <div class="vue-flow__node-input shadow-sm">
        <span class="condition-box pe-2 justify-content-center">
            <span class="condition-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">
                    <path fill="none" stroke="#FFFFFF" stroke-width="2" d="M3,2 L21,12 L3,22 Z"/>
                </svg>
            </span>
            On run</span>

        <Handle :id="`state.run.target.${id}`" type="target" :position="Position.Top" :style="sourceHandleStyleTargetTop" class="handle">
            <span class="circle"/>
        </Handle>
        <Handle :id="`state.run.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleTargetBottom" class="handle">
            <span class="circle"/>
        </Handle>
    </div>
</template>
