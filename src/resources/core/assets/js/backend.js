require('./bootstrap.js')

import Vue from 'vue'
import 'core-js/stable'
import 'regenerator-runtime/runtime'
import Notifications from 'vue-notification'
import {sweetAlert} from './utilities/sweet-alert'

Vue.use(Notifications)

Vue.component('pi-select', (resolve) => {
    require(['./components/utilities/Select.vue'], resolve)
})

Vue.component('pi-sidebar', (resolve) => {
    require(['./components/partials/Sidebar.vue'], resolve)
})

Vue.component('pi-form', (resolve) => {
    require(['./components/utilities/PiForm.vue'], resolve)
})

Vue.component('pi-tabs', (resolve) => {
    require(['./components/utilities/PiTabs.vue'], resolve)
})

Vue.component('pi-modal', (resolve) => {
    require(['./components/utilities/Modal.vue'], resolve)
})

Vue.component('pi-breadcrumbs', (resolve) => {
    require(['./components/utilities/Breadcrumbs.vue'], resolve)
})

Vue.component('accordion', (resolve) => {
    require(['./components/utilities/Accordion.vue'], resolve)
})

Vue.component('pi-table', (resolve) => {
    require(['./components/utilities/Table.vue'], resolve)
})

Vue.component('multiselect', (resolve) => {
    require(['vue-multiselect'], resolve)
})

new Vue({
    el: '#app',
    data: {
        isSidebarActive: false,
    },
    methods: {
        toggleSidebar() {
            this.isSidebarActive = !this.isSidebarActive
        },
        deletePost(postId) {
            sweetAlert.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.axios.delete('/admin/posts/' + postId).then(() => {
                        sweetAlert.fire(
                            'Deleted!',
                            'Your post was deleted.',
                            'success'
                        ).then(() => {
                            window.location.reload()
                        })
                    })
                } else {
                    sweetAlert.fire(
                        'Cancelled',
                        'post was not deleted',
                        'success'
                    )
                }
            })
        },
    },
    components: {
        'edit-page-form': (resolve) => require(
            ['./components/EditPageForm.vue'],
            resolve,
        ),
        'edit-post-form': (resolve) => require(
            ['./components/EditPostForm.vue'],
            resolve,
        ),
        'edit-item-form': (resolve) => require(
            ['./components/EditItemForm.vue'],
            resolve,
        ),
        'options-wrapper': (resolve) => require(
            ['./components/theme-options/OptionsWrapper.vue'],
            resolve,
        ),
        'images': (resolve) => require(['./components/utilities/Images.vue'], resolve)
    }
})