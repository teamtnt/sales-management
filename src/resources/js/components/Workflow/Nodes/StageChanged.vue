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
        <span class="condition-box pe-2 justify-content-end">
            <span class="condition-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-refresh-cw align-middle"><polyline
                    points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path
                    d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span>
            Stagge Changed</span>

        <Handle type="source" :position="Position.Bottom"/>
    </div>
</template>
