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
                     stroke-linejoin="round" class="feather feather-clock align-middle">
                                <circle cx="12" cy="12" r="10"></circle><polyline
                    points="12 6 12 12 16 14"></polyline></svg>
            </span>
            Start
        </span>

        <Handle id="start" type="source" :position="Position.Bottom"/>

    </div>
</template>
