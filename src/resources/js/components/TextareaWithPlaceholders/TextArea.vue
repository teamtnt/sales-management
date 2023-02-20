<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
    errorMessage: {
        type: String,
        required: true
    },
    messageBody: {
        type: String
    }
})

const messageBody = ref('');
const textarea = ref(null);

onMounted(() => {
    messageBody.value = props.messageBody
})

const addPlaceholder = (event, type) => {
    event.preventDefault();

    const textAreaElement = textarea.value
    const index = textAreaElement.selectionStart;
    const placeholderType = `[[${type}]]`;

    messageBody.value = `${messageBody.value.substring(0, index)} ${placeholderType}${messageBody.value.substring(index)}`;
    textAreaElement.focus();
}

</script>

<template>
     <div class="mb-3 position-relative d-flex flex-column align-items-center">
         <label for="body" class="form-label align-self-start">{{ $t('Message Body') }}</label>
         <textarea
             ref="textarea"
             v-model="messageBody"
             name="body"
             id="body"
             :class="[{'is-invalid': errorMessage}, 'form-control']"
             cols="10"
             rows="10">
         </textarea>
         <div class="placeholder-buttons bg-light">
             <span>{{ $t('Add message placeholders')}}:</span>
             <div class="d-flex gap-1">
                 <button @click="addPlaceholder($event,'firstname')" class="btn btn-sm btn-info">{{ $t('Firstname')}}</button>
                 <button @click="addPlaceholder($event,'lastname')" class="btn btn-sm btn-info">{{ $t('Lastname')}}</button>
                 <button @click="addPlaceholder($event,'email')" class="btn btn-sm btn-info">{{ $t('Email')}}</button>
             </div>
         </div>
         <small v-if="errorMessage" class="invalid-feedback">{{ errorMessage }}</small>
     </div>
</template>

<style scoped>
textarea {
    padding-top: 50px;
}

.placeholder-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: absolute;
    top: 1px;
    width: calc(100% - 3px);
    transform: translateY(66%);
    padding: 9px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}
</style>

