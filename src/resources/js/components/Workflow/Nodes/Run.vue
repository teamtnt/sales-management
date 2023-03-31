<script setup>
    import { Handle, Position, useVueFlow } from '@vue-flow/core'
    import { computed, ref } from "vue";
    import { NodeToolbar } from '@vue-flow/node-toolbar'

    const props = defineProps({
        id: String,
        label: String,
        type: String
    });

    const toolBarVisible = ref(false);

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

    const {findNode, onNodeClick, removeNodes} = useVueFlow()
    const node = ref(findNode(props.id));
    node.value.data = {
        "argument": window.workflowId,
    };

    onNodeClick((e) => {
        if(e.node.id === node.value.id) {
            toolBarVisible.value = !toolBarVisible.value
        }
    });

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
    <div class="vue-flow__node-input shadow-sm" style="min-width: 150px; width: 100%; padding-left: 2rem; padding-right: 2rem;">
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
        <span class="condition-box">
            <span class="condition-box__icon">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="margin-left: 5px; margin-top: -1px;">
                        <path fill="none" stroke="#FFFFFF" stroke-width="2" d="M3,2 L21,12 L3,22 Z"/>
                    </svg>
                </span>
            </span>
            {{ node.data.title ?? 'On Run' }}</span>

        <Handle :id="`state.run.target.${id}`" type="target" :position="Position.Top" :style="sourceHandleStyleTargetTop" class="handle">
            <span class="circle"/>
        </Handle>
        <Handle :id="`state.run.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleTargetBottom" class="handle">
            <span class="circle"/>
        </Handle>
    </div>
</template>
