<script setup>
    import {computed, ref} from "vue";
    import {Handle, Position, useVueFlow} from '@vue-flow/core'
    import { NodeToolbar } from '@vue-flow/node-toolbar'

    const props = defineProps({
        id: String,
        label: String,
        type: String
    });
    const toolBarVisible = ref(false);

    const sourceHandleStyleOpened = computed(() => ({
        backgroundColor: 'green',
        left: '48px',
        width: '14px',
        height: '14px',
        right: 'auto',
        bottom: '-7px'

    }));

    const sourceHandleStyleNotOpened = computed(() => ({
        backgroundColor: 'red',
        width: '14px',
        height: '14px',
        right: '40px',
        left: 'auto',
        bottom: '-7px'

    }));

    const sourceHandleStyleTarget = computed(() => ({
        backgroundColor: 'white',
        borderColor: '#dcdbdb',
        borderStyle: 'solid',
        borderWidth: '1px',
        width: '14px',
        height: '14px',
        top: '-6px'
    }));


    let items = window.messagesOpened;
    const {findNode, onNodeClick, removeNodes} = useVueFlow()
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
    }
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
                        <select name="argument" class="form-select form-select-sm" v-model="node.data" id="argument">
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
        <span class="condition-box">
            <span class="condition-box__icon">
                <span>
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="-10 -10 84 84" enable-background="new -10 -10 84 84" xml:space="preserve">
                        <g>
                            <line fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" x1="36" y1="9" x2="45" y2="9"/>
                            <line fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" x1="19" y1="17" x2="45" y2="17"/>
                            <line fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" x1="19" y1="25" x2="45" y2="25"/>
                            <g>
                                <polyline fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" points="1,26 32,45.434 63,26"/>
                                <polyline fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" points="11.334,21.667 1,26 1,63 63,63 63,26 63,26 52.666,21.667"/>
                                <polyline fill="none" stroke="#FFFFFF" stroke-width="3" stroke-miterlimit="10" points="11,32 11,1 53,1 53,32"/>
                            </g>
                        </g>
                    </svg>
                </span>
            </span>
             {{ node.data.title ?? 'Message Opened' }}
        </span>

        <Handle :id="`state.message.opened.target.${id}`" type="target" :position="Position.Top"
                :style="sourceHandleStyleTarget" class="handle"><span class="circle"/></Handle>

        <Handle :id="`state.message.opened.${id}`" type="source" :position="Position.Bottom"
                :style="sourceHandleStyleOpened" class="handle">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
        </Handle>
        <Handle :id="`state.message.not_opened.${id}`" type="source" :position="Position.Bottom"
                :style="sourceHandleStyleNotOpened" class="handle">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </Handle>

    </div>
</template>
