<script setup>
    import {computed, ref} from "vue";
    import {Handle, Position, useVueFlow} from '@vue-flow/core'
    import {NodeToolbar} from '@vue-flow/node-toolbar'

    const props = defineProps({
        id: String,
        label: String,
        type: String
    });

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
    const {findNode} = useVueFlow()
    const node = ref(findNode(props.id));

</script>

<template>
    <div class="vue-flow__node-input shadow-sm">
        <NodeToolbar
            style="display: flex; gap: 0.5rem; align-items: center"
            :is-visible="true"
            :node-id="id"
            :position="Position.Right"
        >
            <select name="argument" class="form-select" v-model="node.data">
                <option v-for="item in items" :value="item">{{ item.title }}</option>
            </select>
        </NodeToolbar>
        <span class="condition-box pe-2 justify-content-end">
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
            Message Opened
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

<!--<style scoped lang="scss">-->
<!--.handle {-->
<!--    display: flex;-->
<!--    align-items: center;-->
<!--    justify-content: center;-->

<!--    .circle {-->
<!--        display: block;-->
<!--        position: absolute;-->
<!--        width: 4px;-->
<!--        height: 4px;-->
<!--        border-radius: 50%;-->
<!--        background-color: gray;-->
<!--        pointer-events: none;-->
<!--    }-->

<!--    & > svg {-->
<!--        position: absolute;-->
<!--        pointer-events: none;-->
<!--    }-->
<!--}-->
<!--</style>-->
