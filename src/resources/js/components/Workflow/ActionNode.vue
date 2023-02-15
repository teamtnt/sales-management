<script setup>
const props = defineProps({
    id: String,
    label: String,
    type: String,
    sourcePosition: String
})
</script>
<template>
    <div class="vue-flow__node-input shadow-sm">
        <span class="action-box pe-2 justify-content-end">
            <span class="action-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-mail align-middle"><path
                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline
                    points="22,6 12,13 2,6"></polyline></svg>
            </span>
            {{ props.label }}
        </span>
        <div data-handleid="54__handle-bottom" data-nodeid="{{ props.id }}"></div>
    </div>
</template>
