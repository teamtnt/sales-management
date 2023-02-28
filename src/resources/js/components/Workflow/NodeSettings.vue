<script setup>
    import {ref} from "vue";

    const props = defineProps({
        nodeType: {
            type: String,
            default: '',
        },
        items: Array
    });
    const selectedNode = ref(props.nodeType);

    const emits = defineEmits(["addData"]);

    const addData = function (item) {
        emits('addData', item);
    }

</script>
<template>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                {{ selectedNode.value }} lala
                <button v-for="item in items" type="button" class="btn btn-primary text-reset" @click="addData(item)" data-bs-dismiss="offcanvas" aria-label="Close">{{ item.title }}</button>
            </div>
        </div>
    </div>
</template>
