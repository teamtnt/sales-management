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

</script>

<template>
    <div class="row w-100 h-100 mx-0">
        <div class="col-lg-12 col-xl-12 col-xxl-12 pe-0">
            <VueFlow
                v-model="elements"
                :node-types="nodeTypes"
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
            </VueFlow>
        </div>
    </div>
</template>
<style lang="scss">

.vue-flow__handle {
    width: 8px;
    height: 8px;
    box-sizing: border-box;
    border-color: transparent;
}
</style>
