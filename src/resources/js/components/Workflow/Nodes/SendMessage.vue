<script setup>
    import {Handle, Position, useVueFlow} from '@vue-flow/core'
    import {computed, ref} from "vue";
    import {NodeToolbar} from '@vue-flow/node-toolbar'

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

    let items = window.messages;
    const {findNode, onNodeClick, removeNodes, onPaneClick} = useVueFlow()
    const node = ref(findNode(props.id));

    onNodeClick((e) => {
        if(e.event.target.classList.contains("handle")) return;

        if(e.node.id === node.value.id) {
            toolBarVisible.value = !toolBarVisible.value
        }
    })

    onPaneClick(() => {
        toolBarVisible.value = false
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
                    <div class="mb-3">
                        <label for="argument" class="form-label" style="font-size: 12px;">Choose Message</label>
                        <select name="argument" class="form-select" v-model="node.data">
                            <option v-for="item in items" :value="item">{{ item.title }}</option>
                        </select>
                    </div>
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
        <span class="action-box ps-1">
            <span class="action-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-mail align-middle"><path
                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline
                    points="22,6 12,13 2,6"></polyline></svg>
            </span>
             {{ node.data.title ?? 'Send Message' }}
        </span>

        <Handle :id="`state.message.sent.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleTargetBottom" class="handle">
            <span class="circle"/>
        </Handle>

        <Handle :id="`state.message.sent.target.${id}`" type="target" :position="Position.Top" :style="sourceHandleStyleTargetTop" class="handle">
            <span class="circle"/>
        </Handle>
    </div>
</template>
