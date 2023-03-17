<script setup>
    import {computed, ref} from "vue";
    import {Handle, Position, useVueFlow} from '@vue-flow/core'
    import {NodeToolbar} from '@vue-flow/node-toolbar'

    const props = defineProps({
        id: String,
        label: String,
        type: String
    });

    const sourceHandleStyleClicked = computed(() => ({
        backgroundColor: 'green',
        left: '48px',
        width: '14px',
        height: '14px',
        right: 'auto',
        bottom: '-7px'

    }));

    const sourceHandleStyleNotClicked = computed(() => ({
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

    let messages = ref(window.messagesWithLinks);

    const {findNode} = useVueFlow()
    const node = ref(findNode(props.id));

    const selectedMessage = computed(() => {
      return messages.value.find(m => m.argument === node.value.data.message) || { links: [] };
    });
    
    node.value.data.argument = computed(() => {
      if (node.value.data.message && node.value.data.link) {
        return `${node.value.data.message}.${node.value.data.link}`;
      }
      return '';
    }); 
</script>

<template>
    <div class="vue-flow__node-input shadow-sm">
        <NodeToolbar
            style="display: flex; gap: 0.5rem; align-items: center"
            :is-visible="true"
            :node-id="id"
            :position="Position.Right"
        >
            <select name="argument" class="form-select" v-model="node.data.message">
              <option v-for="m in messages" :value="m.argument">{{ m.title }}</option>
            </select> <br> <br>
            <select name="argument" class="form-select" v-model="node.data.link">
              <option v-for="link in selectedMessage.links" :value="link.url">{{ link.text }}</option>
            </select>
        </NodeToolbar>
        <span class="condition-box pe-2 justify-content-center">
            <span class="condition-box__icon">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 52.965 52.965" width="15" height="15" xml:space="preserve">
                    <path style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" d="M24.008,13.401L33.2,4.208
                        c4.278-4.278,11.278-4.278,15.556,0l0,0c4.278,4.278,4.278,11.278,0,15.556L36.735,31.786c-4.278,4.278-11.278,4.278-15.556,0l0,0" />
                    <path style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" d="M27.543,40.978l-7.778,7.778
                        c-4.278,4.278-11.278,4.278-15.556,0l0,0c-4.278-4.278-4.278-11.278,0-15.556l11.314-11.314c4.278-4.278,11.278-4.278,15.556,0l0,0" />
                    <line style="fill:none;stroke:#FFFFFF;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;" x1="33.965" y1="45" x2="33.965" y2="51" />
                    <line style="fill:none;stroke:#FFFFFF;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;" x1="37.722" y1="43" x2="41.965" y2="47.243" />
                    <line style="fill:none;stroke:#FFFFFF;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;" x1="38.965" y1="39" x2="44.965" y2="39" />
                    <line style="fill:none;stroke:#FFFFFF;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;" x1="15.965" y1="10" x2="15.965" y2="4" />
                    <line style="fill:none;stroke:#FFFFFF;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;" x1="12.207" y1="12" x2="7.965" y2="7.757" />
                    <line style="fill:none;stroke:#FFFFFF;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;" x1="10.965" y1="16" x2="4.965" y2="16" />
                </svg>
            </span>
            Link Clicked
        </span>

        <Handle :id="`state.link.clicked.target.${id}`" type="target" :position="Position.Top"
                :style="sourceHandleStyleTarget" class="handle"><span class="circle"/></Handle>

        <Handle :id="`state.link.clicked.${id}`" type="source" :position="Position.Bottom"
                :style="sourceHandleStyleClicked" class="handle">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
        </Handle>
        <Handle :id="`state.link.not_clicked.${id}`" type="source" :position="Position.Bottom"
                :style="sourceHandleStyleNotClicked" class="handle">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </Handle>

    </div>
</template>
