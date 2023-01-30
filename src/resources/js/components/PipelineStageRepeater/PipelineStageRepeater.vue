<template>
    <TransitionGroup name="stage-list" appear>
        <div class="d-flex flex-column bg-light mb-3 rounded-3" v-for="(stage, index) in pipelineStages" :key="index">
            <div class="row p-3">
                <h6>#{{ index + 1 }} - {{ stage.stage_name }}</h6>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="stage_name" class="form-label">Stage name</label>
                        <input class="form-control" placeholder="Enter stage name" type="text" id="stage_name"
                               v-model="stage.stage_name">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="stage_description" class="form-label">Stage description</label>
                        <input class="form-control" placeholder="Enter stage description" type="text" id="stage_description"
                               v-model="stage.stage_description">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column mb-3">
                        <label for="stage_color" class="form-label">Stage color</label>
                        <div class="d-flex align-items-center">
                            <input type="color" name="stage_color" id="stage_color" v-model="stage.stage_color"
                                   style="height: 30px;">
                            <span class="fs-4 ms-3">{{ stage.stage_color }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <button @click.prevent="removeStage(stage)" v-show="index || (!index && pipelineStages.length > 1)">Remove Stage</button>
                    <button @click.prevent="addStage" v-show="index === pipelineStages.length - 1">Add new stage</button>
                </div>
            </div>
        </div>
    </TransitionGroup>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({})

const pipelineStages = ref([{stage_name: "", stage_description: "", stage_color: "#366dc7"}])

const addStage = () => {
    pipelineStages.value.push({stage_name: "", stage_description: "", stage_color: "#366dc7"});
}

const removeStage = (stage) => {
    const index = pipelineStages.value.indexOf(stage)
    if(index > -1) {
        pipelineStages.value.splice(index, 1);
    }
}

</script>

<style>
.stage-list-move,
.stage-list-enter-active,
.stage-list-leave-active {
    transition: all 0.25s ease;
}
.stage-list-enter-from,
.stage-list-leave-to {
    opacity: 0;
}
.stage-list-leave-active {
    position: absolute;
}
</style>
