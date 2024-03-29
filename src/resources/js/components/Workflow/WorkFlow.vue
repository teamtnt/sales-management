<script setup>
    import {
        Panel, PanelPosition, Position, VueFlow, useVueFlow
    } from "@vue-flow/core";
    import {Background} from "@vue-flow/background";
    import {nextTick, watch, ref, markRaw} from "vue";
    import Sidebar from "./Sidebar.vue";


    import StageChangedNode from "./Nodes/StageChanged.vue";
    import SendMessageNode from "./Nodes/SendMessage.vue";
    import WaitNode from "./Nodes/Wait.vue";
    import StartNode from "./Nodes/Start.vue";
    import AddTagNode from "./Nodes/AddTag.vue";
    import MessageOpened from "./Nodes/MessageOpened.vue";
    import MoveToList from "./Nodes/MoveToList.vue";
    import ABSplit from "./Nodes/ABSplit.vue";
    import Run from "./Nodes/Run.vue";
    import ChangeStage from "./Nodes/ChangeStage.vue";
    import LinkClicked from "./Nodes/LinkClicked.vue";

    const nodeTypes = {
        "condition.stage.changed": markRaw(StageChangedNode),
        "condition.message.opened": markRaw(MessageOpened),
        "condition.run": markRaw(Run),
        "condition.link.clicked": markRaw(LinkClicked),

        "action.message.sent": markRaw(SendMessageNode),
        "action.wait": markRaw(WaitNode),
        "action.start": markRaw(StartNode),
        "action.add.tag": markRaw(AddTagNode),
        "action.move.to.list": markRaw(MoveToList),
        "action.ab.split": markRaw(ABSplit),
        "action.change.stage": markRaw(ChangeStage),
    };

    const props = defineProps({
        workflowName: {
            type: String,
            default: "Untitled",
        },
        workflowId: {
            type: Number,
            default: null,
        },
        saveUrl: {
            type: String,
            default: "/automation/workflow/save",
        },
        elementsData: {
            type: Array,
            default: [],
        },
        messages: {
            type: Array,
            default: [
                {
                    'argument': 3,
                    'action': 'Message 3',
                    'title': 'Message 3',
                },
            ],
        },
        messagesOpened: {
            type: Array,
            default: [
                {
                    'argument': 3,
                    'action': 'Message 3',
                    'title': 'Message 3',
                },
            ],
        },
        messagesWithLinks: {
            type: Array
        },
        stages: {
            type: Array,
            default: [
                {
                    'argument': '50/50',
                    'action': 'ABSplit',
                    'title': '50/50',
                },
            ],
        },
        tags: {
            type: Array,
            default: [
                {
                    'argument': 'default',
                    'action': 'default',
                    'title': 'default',
                    'type': 'default',
                },
            ],
        },
        stageActions: {
            type: Array,
            default: [
                {
                    'argument': 'default',
                    'action': 'default',
                    'title': 'default',
                    'type': 'default',
                },
            ],
        },
        abSplit: {
            type: Array,
            default: [
                {
                    'argument': '50/50',
                    'action': 'ABSplit',
                    'title': '50/50',
                },
            ],
        },
        contactLists: {
            type: Array,
            default: [
                {
                    'argument': 2,
                    'action': 'contactList 2',
                    'title': 'contactList 2',
                },
            ],
        },
        waitOptions: {
            type: Array,
            default: [
                {
                    'argument': 2,
                    'action': 'contactList 2',
                    'title': 'contactList 2',
                },
            ],
        },
        backUrl: {
            type: String,
            default: "/",
        },
    });
    const elements = ref(props.elementsData);
    const title = ref(props.workflowName);
    let selectedNode = {};

    let id = 0;
    const getId = () => Math.floor((Math.random() * 10000) + 1) + `_${id++}`;

    const {
        findNode, onConnect, nodes, edges, onNodeClick, addEdges, addNodes, viewport, project, vueFlowRef,
    } = useVueFlow({
        nodes: [// {
            //     id: '1',
            //     type: 'input',
            //     label: 'input node',
            //     position: { x: 250, y: 25 },
            // },
        ],
    });

    window.messages = props.messages;
    window.messagesOpened = props.messagesOpened;
    window.contactLists = props.contactLists;
    window.waitOptions = props.waitOptions;
    window.abSplit = props.abSplit;
    window.stages = props.stages;
    window.tags = props.tags;
    window.workflowId = props.workflowId;
    window.stageActions = props.stageActions;
    window.messagesWithLinks = props.messagesWithLinks;

    const onDragOver = (event) => {
        event.preventDefault();

        if (event.dataTransfer) {
            event.dataTransfer.dropEffect = "move";
        }
    };

    onConnect((params) => addEdges([params]));

    const onDrop = (event) => {
        const type = event.dataTransfer?.getData("application/vueflow");
        const {left, top} = vueFlowRef.value.getBoundingClientRect();

        const position = project({
            x: event.clientX - left, y: event.clientY - top,
        });

        const newNode = {
            id: getId(), type, position, label: `${type} node`,
        };

        addNodes([newNode]);

        // align node position after drop, so it's centered to the mouse
        nextTick(() => {
            const node = findNode(newNode.id);
            const stop = watch(
                () => node.dimensions,
                (dimensions) => {
                    if (dimensions.width > 0 && dimensions.height > 0) {
                        node.position = {
                            x: node.position.x - node.dimensions.width / 2,
                            y: node.position.y - node.dimensions.height / 2,
                        };
                        stop();
                    }
                },
                {deep: true, flush: "post"}
            );
        });
    };

    const saveWorkflow = function () {
        //ovdje cemo poslat na server
        axios
            .post(props.saveUrl, {
                elements: elements.value,
                title: title.value,
            })
            .then(function (response) {
                window.notyf.open({
                    type: "success",
                    message: "Workflow successfully saved!",
                    duration: "5000",
                    ripple: true,
                    dismissible: true,
                });
            })
            .catch(function (error) {
                console.log(error);
                window.notyf.open({
                    type: "warning",
                    message: "Something went wrong!",
                    duration: "5000",
                    ripple: true,
                    dismissible: true,
                });
            });
    };

    const addData = function (item) {
        selectedNode.data = item;
        console.log(selectedNode.data)
    }

</script>

<template>
    <div class="row w-100 h-100 mx-0" @drop="onDrop">
        <div class="col-lg-7 col-xl-8 col-xxl-9 pe-0">
            <VueFlow
                @dragover="onDragOver"
                v-model="elements"
                :node-types="nodeTypes"
                :default-edge-options="{ type: 'smoothstep' }"
            >
                <Background/>
                <Panel>
                    <div class="d-flex gap-2">
                        <a
                            class="d-flex align-items-center h4 mb-3 px-4 py-2 text-white bg-info text-decoration-none"
                            :href="backUrl"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-arrow-left-circle align-middle me-2"
                            >
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 8 8 12 12 16"></polyline>
                                <line x1="16" y1="12" x2="8" y2="12"></line>
                            </svg>
                            <span>{{ $t("Back") }}</span></a
                        >
                        <h1 class="h3 mb-3 px-4 py-2 bg-white">
                            {{ title }}
                        </h1>
                    </div>
                </Panel>
                <Panel :position="PanelPosition.BottomRight">
                    <div class="d-flex gap-2">
                        <input
                            type="text"
                            class="form-control"
                            v-model="title"
                            style="min-width: 200px"
                        />
                        <button class="btn btn-success text-uppercase px-4" @click="saveWorkflow">
                            <span class="d-flex align-items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-save align-middle me-2"><path
                                    d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline
                                    points="17 21 17 13 7 13 7 21"></polyline><polyline
                                    points="7 3 7 8 15 8"></polyline></svg>
                                {{ $t("Save") }}
                            </span>
                        </button>
                    </div>
                </Panel>
            </VueFlow>
        </div>
        <div class="col-lg-5 col-xl-4 col-xxl-3 px-0">
            <Sidebar/>
        </div>
    </div>
</template>
<style lang="scss">

.vue-flow__handle {
    width: 8px;
    height: 8px;
    box-sizing: border-box;
    border-color: transparent;
    transition: background-color .15s ease;

    &:hover {
        background-color: #dee6ed !important;
    }
}

.v-enter-active,
.v-leave-active {
    transition: opacity 0.10s ease-in-out;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
