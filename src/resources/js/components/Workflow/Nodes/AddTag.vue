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
        <span class="action-box pe-2 justify-content-center">
            <span class="action-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-tag align-middle"><path
                    d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line
                    x1="7" y1="7" x2="7.01" y2="7"></line></svg>
            </span>
            AddTag
        </span>

        <Handle :id="`state.tag.add.${id}`" type="source" :position="Position.Bottom"/>

        <Handle :id="`state.tag.add.target.${id}`" type="target" :position="Position.Top"/>
    </div>
</template>
