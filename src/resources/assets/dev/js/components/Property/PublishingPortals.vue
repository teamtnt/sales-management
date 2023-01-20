<template>
    <div v-if="alert" class="alert" :class="alert.class" role="alert">
        <div class="alert-icon">
            <i class="far fa-fw fa-bell"></i>
        </div>
        <div class="alert-message">
            {{ $t(alert.message) }}
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <button class="btn btn-success" :class="{ loading: portals.inPublishing }"
                    @click="publishAll()">{{ $t('Publish all') }}
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-warning btn-sm me-2" :class="{ loading: portals.inSync }"
                    @click="syncAll()">{{ $t('Sync all') }}
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-danger btn-sm" :class="{ loading: portals.inUnpublish }"
                    @click="unpublishAll()">{{ $t('Unpublish all') }}
            </button>
        </div>
    </div>
    <div class="row table-responsive">
        <table class="table loading">
            <thead>
            <tr>
                <th>{{ $t('Action') }}</th>
                <th>{{ $t('Portal') }}</th>
                <th>{{ $t('Url') }}</th>
                <th>{{ $t('Published at') }}</th>
                <th>{{ $t('Updated at') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="portal in propertyPortals">
                <td>
                    <template v-if="!portal.disabled">
                        <template v-if="typeof portal.publishedAt === 'undefined' || portal.publishedAt === null">
                            <button class="btn btn-success" :class="{ loading: portal.inPublishing }"
                                    @click="publishProperty(portal)">{{ $t('Publish') }}
                            </button>
                        </template>
                        <template v-else>
                            <button class="btn btn-warning btn-sm me-2" :class="{ loading: portal.inSync }"
                                    @click="syncProperty(portal)">{{ $t('Sync') }}
                            </button>
                            <button class="btn btn-danger btn-sm" :class="{ loading: portal.inUnpublish }"
                                    @click="unpublishProperty(portal)">{{ $t('Unpublish') }}
                            </button>
                        </template>
                    </template>
                    <template v-else>
                        <p>{{ $t('Disabled') }}</p>
                        <p class="small">{{ portal.disabledMsg }}</p>
                    </template>
                </td>
                <td>{{ $t(portal.name) }}</td>
                <template v-if="typeof portal.publishedAt === 'undefined' || portal.publishedAt === null">
                    <td>{{ $t('N/A') }}</td>
                    <td>{{ $t('N/A') }}</td>
                    <td>{{ $t('N/A') }}</td>
                </template>
                <template v-else>
                    <td>
                        <a class="btn btn-sm btn-success" v-if="portal.publishedUrl" :href="portal.publishedUrl"
                           target="_blank">{{ $t('Open') }}</a>
                        <a class="btn btn-sm btn-primary" v-if="!portal.publishedUrl" href="">{{ $t('Fetch URL') }}</a>
                    </td>
                    <td>{{ portal.publishedAt }}</td>
                    <td>{{ portal.updatedAt }}</td>
                </template>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>

export default {
    props: {
        propertyPortalsData: {
            type: Array,
            default: function () {
                return []
            }
        },
        propertyId: {
            type: Number,
            default: null
        },
    },
    data() {
        return {
            propertyPortals: this.propertyPortalsData,
            alert: null,
            portals: {
                inPublishing: false,
                inSync: false,
                inUnpublish: false,
            }
        };
    },
    methods: {
        async publishProperty(portal) {
            if (!(typeof portal.publishedAt === 'undefined'
                || portal.publishedAt === null
                || portal.inSync
                || portal.inUnpublish)) {
                this.checkInPublishingPortals();
                return;
            }
            portal.inPublishing = true;
            let data = {propertyId: this.propertyId};
            let response = await axios.post(portal.publishUrl, data)
                .then(resp => {
                    this.alert = {
                        class: 'alert-success',
                        message: resp.data.message,
                    }
                    console.log(resp.data.data)
                    portal.publishedAt = resp.data.data.publishedAt;
                    portal.updatedAt = resp.data.data.updatedAt;
                    portal.publishedUrl = resp.data.data.publishedUrl;
                    portal.inPublishing = false;
                    this.checkInPublishingPortals();
                    return resp;
                }).catch(error => {
                    this.alert = {
                        class: 'alert-danger',
                        message: 'Error while publishing property, try again later.',
                    }
                    portal.inPublishing = false;
                    this.checkInPublishingPortals();
                    return error;
                });
        },
        async unpublishProperty(portal) {
            if (typeof portal.publishedAt === 'undefined'
                || portal.publishedAt === null
                || portal.inSync
                || portal.inPublishing) {
                this.checkInUnpublishPortals();
                return;
            }
            portal.inUnpublish = true;
            let data = {propertyId: this.propertyId};
            let response = await axios.post(portal.unpublishUrl, data)
                .then(resp => {
                    this.alert = {
                        class: 'alert-success',
                        message: resp.data.message,
                    }
                    portal.publishedAt = resp.data.data.publishedAt;
                    portal.updatedAt = resp.data.data.updatedAt;
                    portal.publishedUrl = resp.data.data.publishedUrl;
                    portal.inUnpublish = false;
                    this.checkInUnpublishPortals();
                    return resp;
                }).catch(error => {
                    this.alert = {
                        class: 'alert-danger',
                        message: 'Error while unpublishing property, try again later.',
                    }
                    portal.inUnpublish = false;
                    this.checkInUnpublishPortals();
                    return error;
                });
        },
        async syncProperty(portal) {
            if (typeof portal.publishedAt === 'undefined'
                || portal.publishedAt === null
                || portal.inUnpublish
                || portal.inPublishing) {
                this.checkInSyncPortals();
                return;
            }
            portal.inSync = true;
            let data = {propertyId: this.propertyId};
            let response = await axios.post(portal.syncUrl, data)
                .then(resp => {
                    this.alert = {
                        class: 'alert-success',
                        message: resp.data.message,
                    }
                    portal.publishedAt = resp.data.data.publishedAt;
                    portal.updatedAt = resp.data.data.updatedAt;
                    portal.publishedUrl = resp.data.data.publishedUrl;
                    portal.inSync = false;
                    this.checkInSyncPortals();
                    return resp;
                }).catch(error => {
                    this.alert = {
                        class: 'alert-danger',
                        message: $t('Error while syncing property, try again later.'),
                    }
                    portal.inSync = false;
                    this.checkInSyncPortals();
                    return error;
                });
        },
        checkInUnpublishPortals() {
            this.inUnpublishPortals = false;
            this.propertyPortals.forEach(function (portal) {
                this.inUnpublishPortals = this.inUnpublishPortals || portal.inUnpublish;
            }, this);
            this.portals.inUnpublish = this.inUnpublishPortals;
        },
        checkInSyncPortals() {
            this.inSyncPortals = false;
            this.propertyPortals.forEach(function (portal) {
                this.inSyncPortals = this.inSyncPortals || portal.inSync;
            }, this);
            this.portals.inSync = this.inSyncPortals;
        },
        checkInPublishingPortals() {
            this.inPublishingPortals = false;
            this.propertyPortals.forEach(function (portal) {
                this.inPublishingPortals = this.inPublishingPortals || portal.inPublishing;
            }, this);
            this.portals.inPublishing = this.inPublishingPortals;
        },
        async publishAll() {
            this.portals.inPublishing = true;
            this.propertyPortals.forEach(function (portal) {
                this.publishProperty(portal, this.propertyId);
            }, this);
        },
        async unpublishAll() {
            this.portals.inUnpublish = true;
            this.propertyPortals.forEach(function (portal) {
                this.unpublishProperty(portal, this.propertyId);
            }, this);
        },
        async syncAll() {
            this.portals.inSync = true;
            this.propertyPortals.forEach(function (portal) {
                this.syncProperty(portal, this.propertyId);
            }, this);
        }
    }
}
</script>
