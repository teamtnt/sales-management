<script setup>
import {Panel, VueFlow, useVueFlow} from '@vue-flow/core'
import {Background} from '@vue-flow/background'
import {nextTick, watch, ref, markRaw} from 'vue'
import Sidebar from './Sidebar.vue'

import ConditionNode from './ConditionNode.vue'
import ActionNode from "./ActionNode.vue";

const nodeTypes = {
    condition: markRaw(ConditionNode),
    action: markRaw(ActionNode)
}

const props = defineProps({
    panelTitle: {
        type: String,
        default: "Workflow"
    }
})

const elements = ref([
    // Nodes
    // An input node, specified by using `type: 'input'`
    {id: '1', type: 'condition', label: 'Node 1', class: 'condition-node', position: {x: 350, y: 100}},

    // Default nodes, you can omit `type: 'default'`
    {id: '2', type: 'action', label: 'Node 2', position: {x: 100, y: 200},},
    {id: '3', type: 'action', label: 'Node 3', position: {x: 400, y: 200}},

    // An output node, specified by using `type: 'output'`
    {id: '4', type: 'condition', label: 'Node 4', position: {x: 400, y: 300}},

    // Edges
    // Most basic edge, only consists of an id, source-id and target-id
    {id: 'e1-3', source: '1', target: '3'},
    {id: 'e1-3', source: '3', target: '4'},

    // An animated edge
    {id: 'e1-2', source: '1', target: '2', animated: true},
])

let id = 0
const getId = () => `dndnode_${id++}`

const {findNode, onConnect, nodes, edges, addEdges, addNodes, viewport, project, vueFlowRef} = useVueFlow({
    nodes: [
        // {
        //     id: '1',
        //     type: 'input',
        //     label: 'input node',
        //     position: { x: 250, y: 25 },
        // },
    ],
})

const onDragOver = (event) => {
    event.preventDefault()

    if (event.dataTransfer) {
        event.dataTransfer.dropEffect = 'move'
    }
}

onConnect((params) => addEdges([params]))

const onDrop = (event) => {
    const type = event.dataTransfer?.getData('application/vueflow')

    const {left, top} = vueFlowRef.value.getBoundingClientRect()

    const position = project({
        x: event.clientX - left,
        y: event.clientY - top,
    })

    const newNode = {
        id: getId(),
        type,
        position,
        label: `${type} node`,
    }

    addNodes([newNode])

    // align node position after drop, so it's centered to the mouse
    nextTick(() => {
        const node = findNode(newNode.id)
        const stop = watch(
            () => node.dimensions,
            (dimensions) => {
                if (dimensions.width > 0 && dimensions.height > 0) {
                    node.position = {
                        x: node.position.x - node.dimensions.width / 2,
                        y: node.position.y - node.dimensions.height / 2
                    }
                    stop()
                }
            },
            {deep: true, flush: 'post'},
        )
    })
}
</script>

<template>
    <div class="row w-100 h-100 mx-0" @drop="onDrop">
        <div class="col-md-10 pe-0">
            <VueFlow @dragover="onDragOver" v-model="elements" :node-types="nodeTypes">
                <Background/>
                <Panel><h1 class="h3 mb-3 px-4 py-2 bg-white">{{ panelTitle }}</h1></Panel>
            </VueFlow>
        </div>
        <div class="col-md-2 px-0">
            <Sidebar/>
        </div>
    </div>
</template>
