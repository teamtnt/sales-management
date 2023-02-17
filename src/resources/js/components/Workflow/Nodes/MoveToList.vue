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

        <span class="action-box pe-2 justify-content-center">
            <span class="action-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-list align-middle">
                                <line x1="8" y1="6" x2="21" y2="6"></line><line
                    x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line
                    x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line
                    x1="3" y1="18" x2="3.01" y2="18"></line></svg>
            </span>
            Move To List
        </span>

        <Handle id="source" type="source" :position="Position.Bottom"/>

        <Handle id="target" type="target" :position="Position.Top"/>
    </div>
</template>
