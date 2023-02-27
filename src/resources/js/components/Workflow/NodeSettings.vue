<template>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <button v-for="item in items" type="button" class="btn btn-primary text-reset" @click="addData(item)" data-bs-dismiss="offcanvas" aria-label="Close">{{ item.title }}</button>
            </div>
        </div>
    </div>
</template>
<script setup>
    const props = defineProps({
        node: String,
        items: Array
    });

    const emits = defineEmits(["addTodo"]);

    const addData = function (item) {
        emits('addData', item);
    }
</script>