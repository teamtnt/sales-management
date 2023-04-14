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

    let items = window.abSplit;
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
                        <label for="argument" class="form-label" style="font-size: 12px;">Choose split</label>
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
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                    <line x1="12" y1="16" x2="12" y2="16"></line>
                    <line x1="12" y1="8" x2="12" y2="8"></line>
                </svg>
            </span>
             {{ node.data.title ?? 'A/B Split' }}
        </span>

        <Handle :id="`state.abSplit.target.${id}`" type="target" :position="Position.Top" :style="sourceHandleStyleTarget" class="handle">
            <span class="circle"/>
        </Handle>

        <Handle :id="`state.abSplit.left.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleOpened" class="handle">
            <span class="circle"/>
        </Handle>
        <Handle :id="`state.abSplit.right.${id}`" type="source" :position="Position.Bottom" :style="sourceHandleStyleNotOpened" class="handle">
            <span class="circle"/>
        </Handle>
    </div>
</template>
