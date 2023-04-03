<script setup>
    import { Handle, Position, useVueFlow } from '@vue-flow/core'
    import { computed, ref } from "vue";
    import {NodeToolbar} from '@vue-flow/node-toolbar'

    const props = defineProps({
        id: String,
        label: String,
        type: String
    })

    const toolBarVisible = ref(false);

    const sourceHandleStyleTarget = computed(() => ({
        backgroundColor: 'white',
        borderColor: '#dcdbdb',
        borderStyle: 'solid',
        borderWidth: '1px',
        width: '14px',
        height: '14px',
        bottom: '-6px'

    }));

    const {findNode, onNodeClick, removeNodes} = useVueFlow();
    const node = ref(findNode(props.id));

    onNodeClick((e) => {
        if(e.node.id === node.value.id) {
            toolBarVisible.value = !toolBarVisible.value
        }
    })

    const deleteNode = (node) => {
        removeNodes([node],true);
        window.notyf.open({
            type: "success",
            message: "Node successfully deleted!",
            duration: "3000",
            ripple: true,
            dismissible: true,
        });
    };
</script>
<template>
    <div class="vue-flow__node-input shadow-sm">
        <NodeToolbar
            style="display: flex; gap: 0.5rem; align-items: center"
            :is-visible="toolBarVisible"
            :node-id="id"
            :position="Position.Right">
            <transition mode="in-out" appear>
                <div class="bg-white p-3 rounded-3">
                    <h5 class="mb-3">
                        <span class="d-flex align-items-center"><i class="align-middle me-1 fas fa-fw fa-cogs"></i>Node Properties</span>
                    </h5>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-danger btn-sm rounded-2" @click="deleteNode(node)">
                            <span class="d-flex align-items-center">
                                <i class="align-middle me-1 fas fa-fw fa-trash"></i>Delete Node
                            </span>
                        </button>
                    </div>
                </div>
            </transition>
        </NodeToolbar>
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
