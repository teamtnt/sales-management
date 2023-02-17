<script setup>
import {Handle, Position} from '@vue-flow/core'

const props = defineProps({
    id: String,
    label: String,
    type: String
})
</script>
<template>
    <div class="vue-flow__node-input shadow-sm">

        <div :data-handleid="`${id}__handle-top`" :data-nodeid="id" data-handlepos="top"
             :class="`vue-flow__handle nodrag vue-flow__handle-top vue-flow__handle-${id}__handle-top target connectable`"></div>

        <span class="action-box pe-2 justify-content-end">
            <span class="action-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-mail align-middle"><path
                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline
                    points="22,6 12,13 2,6"></polyline></svg>
            </span>
            Send Message
        </span>

        <Handle id="source" type="source" :position="Position.Top"/>

        <Handle id="target" type="target" :position="Position.Bottom"/>
    </div>
</template>
