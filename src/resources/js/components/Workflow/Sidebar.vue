<script setup>
    const onDragStart = (event, nodeType, label) => {
        if (event.dataTransfer) {
            event.dataTransfer.setData('application/vueflow', nodeType)
            event.dataTransfer.effectAllowed = 'move'
        }
    }
</script>

<template>
    <aside class="bg-light h-100 shadow-lg">
        <h5 class="sidebar-heading py-3 px-2">
            <span class="d-flex align-items-center justify-content-center fw-lighter text-center">
                <svg width="20" height="20"
                     viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     class="feather feather-move align-middle me-2"><polyline
                    points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline
                    points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <line x1="12" y1="2" x2="12" y2="22"></line>
                </svg>You can drag these nodes to the pane</span>
        </h5>
        <div class="d-flex flex-column gap-2">
            <div class="d-flex flex-wrap gap-2 align-items-center my-3 px-4">
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'action.start')">
                    <span class="start-box px-3 justify-content-center">
                        <span class="start-box__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                        </span>
                        Start
                    </span>
                </div>
            </div>
            <div class="bg-white shadow-sm px-3 py-2">
                <h6 class="mb-0">
                    <span class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-git-pull-request align-middle me-2">
                            <circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle>
                            <path d="M13 6h3a2 2 0 0 1 2 2v7"></path><line x1="6" y1="9" x2="6" y2="21"></line></svg>
                        Conditions</span></h6>
            </div>
            <div class="d-flex flex-wrap gap-4 align-items-center my-3 px-4">
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'condition.stage.changed')">
                    <span class="condition-box pe-2 justify-content-end">
                        <span class="condition-box__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-refresh-cw align-middle"><polyline
                                points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path
                                d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span>
                        Stage Changed</span>
                </div>
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'condition.message.opened')">
                    <span class="condition-box pe-2 justify-content-end">
                        <span class="condition-box__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-refresh-cw align-middle"><polyline
                                points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path
                                d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span>
                        Message Opened
                    </span>
                </div>
            </div>

            <div class="bg-white shadow-sm px-3 py-2">
                <h6 class="mb-0">
                    <span class="d-flex align-items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-repeat align-middle me-2"><polyline
                            points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline
                            points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                        Actions</span></h6>
            </div>
            <div class="d-flex flex-wrap gap-4 align-items-center my-3 px-4">
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'action.message.sent')">
                    <span class="action-box pe-2 justify-content-end">
                        <span class="action-box__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-mail align-middle"><path
                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline
                                points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                        Send Message
                    </span>
                </div>
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'action.wait')">
                    <span class="action-box px-3 justify-content-center">
                        <span class="action-box__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-clock align-middle">
                                <circle cx="12" cy="12" r="10"></circle><polyline
                                points="12 6 12 12 16 14"></polyline></svg>
                        </span>
                        Wait
                    </span>
                </div>
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'action.add.tag')">
                    <span class="action-box ps-2 justify-content-center">
                        <span class="action-box__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-tag align-middle"><path
                                d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line
                                x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                        </span>
                        Add Tag
                    </span>
                </div>
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'action.move.to.list')">
                    <span class="action-box ps-2 justify-content-center">
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
                </div>
                <div class="vue-flow__node-input shadow-sm" :draggable="true"
                     @dragstart="onDragStart($event, 'action.ab.split')">
                    <span class="action-box ps-2 justify-content-center">
                        <span class="action-box__icon">
                            <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                                <line x1="12" y1="16" x2="12" y2="16"></line>
                                <line x1="12" y1="8" x2="12" y2="8"></line>
                            </svg>
                        </span>
                        A/B Split
                    </span>
                </div>
            </div>
        </div>
    </aside>
</template>

<style lang="scss">
.sidebar-heading {
    margin-bottom: 0;
    text-transform: uppercase;
    background: #a2999e;
    color: white;
}

.vue-flow__node-input {
    position: relative;
    border: 0;
    cursor: grab;

    &:active {
        cursor: grabbing;
    }
}

.condition-box {
    display: flex;
    align-items: center;

    &__icon {
        position: absolute;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        color: white;
        background-color: #4E68D0;
        transform: translate(-40%, 0%) rotate(45deg);
        transform-origin: center;
    }
}

.start-box {
    display: flex;
    align-items: center;

    &__icon {
        position: absolute;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        color: white;
        background-color: #f75b00;
        transform: translate(-50%, 0%);
        transform-origin: center;
        border-radius: 50%;
    }
}

.action-box {
    display: flex;
    align-items: center;

    &__icon {
        position: absolute;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        color: white;
        background-color: #00BD9D;
        transform: translate(-30%, 0%);
        transform-origin: center;
    }
}
</style>
