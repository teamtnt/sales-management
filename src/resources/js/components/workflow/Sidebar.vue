<script setup>
const onDragStart = (event, nodeType) => {
    console.log(event)
    if (event.dataTransfer) {
        event.dataTransfer.setData('application/vueflow', nodeType)
        event.dataTransfer.effectAllowed = 'move'
    }
}
</script>

<template>
    <aside>
        <div class="description">You can drag these nodes to the pane.</div>

        <div class="nodes d-flex gap-2">
            <div class="vue-flow__node-input" :draggable="true" @dragstart="onDragStart($event, 'default')">
                Ovo ce biti condition i trebalo bi na lijevoj strani imat nest u obliku dijamanta, a na desnoj opis
            </div>

            <div class="vue-flow__node-default" :draggable="true" @dragstart="onDragStart($event, 'default')">
                Ovo ce biti action i trebalo bi na lijevoj strani imat kocku a na desnoj opis akcije
            </div>
        </div>
    </aside>
</template>
