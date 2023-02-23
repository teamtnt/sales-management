<script setup>
    import {Panel, PanelPosition, Position, VueFlow, useVueFlow} from '@vue-flow/core'
    import {Background} from '@vue-flow/background'
    import {nextTick, watch, ref, markRaw} from 'vue'
    import Sidebar from './Sidebar.vue'

    import StageChangedNode from "./Nodes/StageChanged.vue";
    import SendMessageNode from "./Nodes/SendMessage.vue";
    import WaitNode from "./Nodes/Wait.vue";
    import StartNode from "./Nodes/Start.vue";
    import AddTagNode from "./Nodes/AddTag.vue";
    import MessageOpened from "./Nodes/MessageOpened.vue";
    import MoveToList from "./Nodes/MoveToList.vue";

    const nodeTypes = {
        'stage.changed': markRaw(StageChangedNode),
        'message.sent': markRaw(SendMessageNode),
        wait: markRaw(WaitNode),
        start: markRaw(StartNode),
        addTag: markRaw(AddTagNode),
        move_to_list: markRaw(MoveToList),
        'message.opened': markRaw(MessageOpened),
    }

    const props = defineProps({
        panelTitle: {
            type: String,
            default: "Workflow"
        },
        elementsData: {
            type: Array,
            default: []
        }
    })
    const elements = ref(props.elementsData)

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

    const saveWorkflow = function () {
        //ovdje cemo poslat na server
        axios.post('/automation/workflow/save', {
            elements: elements.value
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

        console.log(elements.value);
        alert("Workflow saved");
    }
</script>

<template>
    <div class="row w-100 h-100 mx-0" @drop="onDrop">
        <div class="col-lg-7 col-xl-8 col-xxl-9 pe-0">
            <VueFlow @dragover="onDragOver" v-model="elements"
                     :node-types="nodeTypes">
                <Background/>
                <Panel><h1 class="h3 mb-3 px-4 py-2 bg-white">{{ panelTitle }}</h1></Panel>
                <Panel :position="PanelPosition.BottomRight">
                    <button class="btn btn-success me-2" @click="saveWorkflow">{{ $t("Save") }}</button>
                    <button class="btn btn-danger">{{ $t("Cancel") }}</button>
                </Panel>
            </VueFlow>
        </div>
        <div class="col-lg-5 col-xl-4 col-xxl-3 px-0">
            <Sidebar/>
        </div>
    </div>
</template>
