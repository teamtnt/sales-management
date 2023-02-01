<template>
    <TransitionGroup name="stage-list" appear>
        <div class="d-flex flex-column bg-light mb-3 rounded-3" v-for="(pipelineStage, index) in pipelineStages"
             :key="index">
            <div class="row p-3">
                <div class="d-flex justify-content-between">
                    <h6>#{{ index + 1 }} - {{ pipelineStage.name }}</h6>
                    <div>
                        <button class="btn text-danger btn-lg border-0 p-0"
                                @click.prevent="removeStage(pipelineStage)"
                                title="Remove Stage"
                                v-show="index || (!index && pipelineStages.length > 1)">
                            <i class="align-middle fas fa-fw fa-minus-circle"></i>
                        </button>
                        <button class="btn text-info btn-lg border-0 p-0"
                                title="Add New Stage"
                                @click.prevent="addStage"
                                v-show="index === pipelineStages.length - 1">
                            <i class="align-middle ms-2 fas fa-fw fa-plus-circle"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="stage_name" class="form-label">Stage name</label>
                        <input class="form-control" :name="`pipeline_stages[${index}][name]`"
                               placeholder="Enter stage name" type="text" id="stage_name"
                               v-model="pipelineStage.name">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="stage_description" class="form-label">Stage description</label>
                        <input class="form-control" :name="`pipeline_stages[${index}][description]`"
                               placeholder="Enter stage description" type="text" id="stage_description"
                               v-model="pipelineStage.description">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column mb-3">
                        <label for="stage_color" class="form-label">Stage color</label>
                        <div class="d-flex align-items-center">
                            <input type="color" :name="`pipeline_stages[${index}][color]`" id="stage_color"
                                   v-model="pipelineStage.color"
                                   style="height: 30px;">
                            <span class="fs-4 ms-3">{{ pipelineStage.color }}</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" :name="`pipeline_stages[${index}][id]`" :value="pipelineStage.id">
            </div>
        </div>
    </TransitionGroup>
</template>

<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
    stages: {
        type: Array,
    }
})

const pipelineStages = ref([
    {name: "Default", description: "This is some description", color: "#366dc7"}
]);

onMounted(() => {
    if(props.stages.length) {
        pipelineStages.value = props.stages
    }
})

const addStage = () => {
    pipelineStages.value.push({name: "", description: "", color: "#366dc7"});
}

const removeStage = (stage) => {
    const index = pipelineStages.value.indexOf(stage);

    if (index > -1) {
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
