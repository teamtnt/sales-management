<template>
     <div v-if="modelValue"
          ref="offCanvasRef"
          class="offcanvas offcanvas-end"
          tabindex="-1"
          id="offcanvasRight"
          aria-labelledby="offcanvasRightLabel"
     >
         <div class="offcanvas-header bg-light border-bottom">
             <h5 class="offcanvas-title" id="offcanvasRightLabel">
                 <span class="d-flex align-items-center">
                     <svg class="me-2 flex-shrink-0" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                     </svg>
                     {{ $t('User') }}: {{ leadFullName }}
                 </span>
             </h5>
             <button @click="emit('update:modelValue', false)" type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <ul class="nav nav-tabs" id="lead-tabs" role="tablist" style="font-size: 12px;">
             <li class="nav-item" role="presentation">
                 <button class="nav-link active text-uppercase btn-tab" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                        aria-controls="profile-tab-pane"
                        aria-selected="true">{{ $t('Profile') }}
                 </button>
             </li>
             <li class="nav-item" role="presentation">
                 <button class="nav-link text-uppercase btn-tab" id="notes-tab" data-bs-toggle="tab"
                        data-bs-target="#notes-tab-pane" type="button" role="tab"
                        aria-controls="notes-tab-pane"
                        aria-selected="false">{{ $t('Notes') }}
                 </button>
             </li>

             <li class="nav-item" role="presentation">
                 <button class="nav-link text-uppercase btn-tab" id="activities-tab" data-bs-toggle="tab"
                        data-bs-target="#activities-tab-pane" type="button" role="tab"
                        aria-controls="activities-tab-pane"
                        aria-selected="false">{{ $t('Activities') }}
                 </button>
             </li>

             <li class="nav-item" role="presentation">
                 <button class="nav-link text-uppercase btn-tab" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#message-tab-pane" type="button" role="tab"
                        aria-controls="message-tab-pane"
                        aria-selected="false">{{ $t('Send E-Mail') }}
                 </button>
             </li>
         </ul>
         <div class="tab-content" id="myTabContent" style="overflow-y: auto;">
             <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel"
                 aria-labelledby="profile-tab"
                 tabindex="0">
                 <div class="offcanvas-body">
                     <dl class="row mb-4 data-list">
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('User ID') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.id }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Firstname') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.firstname }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0"><strong>{{ $t('Lastname') }}:</strong></dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.lastname }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Job title') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.job_title }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Email') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.email }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Phone') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.phone }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Company') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.company_name }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('VAT') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.vat }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Contact') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.company_email }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Website') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.url }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Address') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.address }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('ZIP') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.postal }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('City') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.city }}</p>
                         </dd>
                         <dt class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Country') }}:</strong>
                         </dt>
                         <dd class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1">{{ lead.contact.country }}</p>
                         </dd>
                         <dt v-if="lead.contact.external_profile_url" class="col-4 col-xxl-3 mb-0">
                             <strong>{{ $t('Profile URL') }}:</strong>
                         </dt>
                         <dd v-if="lead.contact.external_profile_url" class="col-8 col-xxl-9 mb-0">
                             <p class="mb-1"><a :href="lead.contact.external_profile_url" target="_blank">{{ lead.contact.external_profile_url }}</a></p>
                         </dd>

                    </dl>
                    <div class="mb-4">
                        <span class="d-flex fw-bold align-items-center mb-2">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
                            </svg>{{ $t('Contact Tags') }}
                        </span>
                        <multi-select-list
                            name=tags[]
                            label="Add tag to contact"
                            placeholder="Choose tags..."
                            label-by="name"
                            track-by="name"
                            :sync-tags-url="routes.contacts.syncTags"
                            :model-id="lead.contact.id"
                            :selected="lead.contact.tags ?? []"
                            :options="tags ?? []"
                            :key="lead.contact.id"
                            >
                        </multi-select-list>
                    </div>
                    <div class="mb-4">
                        <span class="d-flex fw-bold align-items-center mb-2">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
                            </svg>{{ $t('Lists') }}
                        </span>
                        <multi-select-list
                            name=tags[]
                            label="Add to Lists"
                            placeholder="Choose list..."
                            label-by="name"
                            track-by="name"
                            :sync-tags-url="routes.contacts.syncLists"
                            :model-id="lead.contact.id"
                            :selected="lead.contact.lists ?? []"
                            :options="lists ?? []"
                            :key="lead.contact.id">
                        </multi-select-list>
                    </div>
                    <div class="mb-4">
                        <span class="d-flex fw-bold align-items-center mb-2">
                             <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
                            </svg>{{ $t('Lead Tags') }}
                        </span>
                        <multi-select-list
                            name=tags[]
                            label="Add tag to lead"
                            placeholder="Choose tags..."
                            label-by="name"
                            track-by="name"
                            :sync-tags-url="routes.leads.syncTags"
                            :model-id="lead.id"
                            :selected="lead.tags ?? []"
                            :options="tags ?? []"
                        :key="lead.id">
                        </multi-select-list>
                    </div>
                     <div style="height: 50px; margin-bottom: 50px;"></div>
                </div>
            </div>

            <div class="tab-pane fade"
                 id="notes-tab-pane"
                 role="tabpanel"
                 aria-labelledby="notes-tab"
                 tabindex="0">
                <div class="offcanvas-body">
                    <notes
                        :lead-id="lead.id"
                        :lead-notes="lead.notes"
                        :url="routes.notes.store"
                        :delete-url="routes.notes.delete"
                        :key="lead.id">
                    </notes>
                </div>
            </div>

            <div class="tab-pane fade" id="activities-tab-pane" role="tabpanel"
                 aria-labelledby="activities-tab" tabindex="0">
                <div class="offcanvas-body">
                    <activities
                        :lead-id="lead.id"
                        :lead-activities="lead.activities"
                        :url="routes.activities.store"
                        :delete-url="routes.activities.delete"
                        :key="lead.id">
                    </activities>
                </div>
            </div>
             <div class="tab-pane fade" id="message-tab-pane" role="tabpanel"
                  aria-labelledby="message-tab" tabindex="0">
                 <div class="offcanvas-body">
                     <send-email-form />
                 </div>
             </div>
         </div>
     </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import { onClickOutside } from '@vueuse/core'
import Notes from "../Notes/Notes.vue";
import Activities from "../Notes/Activities.vue";
import MultiSelectList from "../MultiSelectList/MultiSelectList.vue";
import SendEmailForm from "./SendEmailForm.vue";

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false
    },
    lead: {
        type: Object,
        required: true
    },
    routes: {
        type: Object,
        required: true
    },
    tags: {
        type: Array,
        required: true
    },
    lists: {
        type: Array,
        required: true
    }
})

const emit = defineEmits(['update:modelValue'])
const offCanvasRef = ref(null)

onMounted(() => {
    const offCanvasElement = document.getElementById('offcanvasRight')
    const offcanvas = new bootstrap.Offcanvas(offCanvasElement)
    offcanvas.show()
})

onBeforeUnmount(() => {
    const offCanvasElement = document.getElementById('offcanvasRight')
    const offcanvas = new bootstrap.Offcanvas(offCanvasElement)

    offCanvasRef.value.addEventListener('hidden.bs.offcanvas', () => {
        emit('update:modelValue', false)
    });
    offcanvas.hide()
})

onClickOutside(offCanvasRef, () => {
        emit('update:modelValue', false)
    },
);

const leadFullName = computed(() => {
    return `${props.lead.contact?.firstname} ${props.lead.contact?.lastname}`
})

</script>

<style scoped>
.btn-tab {
    padding: 8px 15px;
}
.data-list dt, .data-list dd {
    font-size: 11px;
}
</style>
