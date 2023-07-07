<template>
    <div class="images">
        <div class="row row-eq-height">
            <div class="col-xl-4 mb-5" v-for="image in images">
                <div class="image-wrapper p-4 cursor-pointer" @click.self="imageSelected(image)">
                    <div class="action-buttons d-block text-right mb-3">
                        <i class="fas fa-edit mr-1 x cursor-pointer" @click="imageSelected(image)"></i>
                        <i class="fas fa-trash cursor-pointer" @click="removeImage(image.id)"></i>
                    </div>
                    <img :src="'/' + image.url" :alt="image.alt" class="img img-fluid mb-4"
                         @click="imageSelected(image)">
                </div>
            </div>
            <pi-modal :active="active" @hide="active = false">
                <template #header>Update Image</template>
                <template #content>
                    <div class="row">
                        <div class="col-xl-6">
                            <img :src="'/' + currentImage.url" :alt="currentImage.title" v-if="currentImage.url"
                                 class="img img-fluid">
                        </div>
                        <div class="col-xl-6">
                            <form class="update-image p-4" @submit.prevent="updateImage(currentImage.id)">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" v-model="currentImage.title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="alt">Alt</label>
                                    <input type="text" v-model="currentImage.alt" id="alt" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <textarea rows="3" class="form-control" id="caption"
                                              v-model="currentImage.caption"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </template>
            </pi-modal>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <pagination :current="pagination.current" :total-pages="pagination.totalPages"
                            :total="pagination.total" :max-visible-buttons="5" @changed="setCurrentPage"
                            v-show="pagination.totalPages.length > 1"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from './Pagination'
    import { sweetAlert } from '../../utilities/sweet-alert.js'

    export default {
        name: 'Images',
        data () {
            return {
                images: [],
                currentImage: {},
                active: false,
                pagination: {
                    current: 1,
                    totalPages: [1],
                    perPage: 10,
                    total: 10,
                },
            }
        },
        created () {
            this.getImages()
        },
        methods: {
            getImages () {
                let url = '/admin/images?page=' + this.pagination.current
                axios.get(url).then(({ data }) => {
                    this.images = data.images.data
                    this.pagination.current = data.images.current_page
                    this.pagination.totalPages = Array(data.images.last_page).fill().map((_, i) => i + 1)
                    this.pagination.total = data.images.total
                    this.pagination.perPage = data.images.per_page
                    this.images.forEach((image) => {
                        this.$set(image, 'active', false)
                    })
                })
            },
            removeImage (id) {
                sweetAlert.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/admin/images/' + id).then(() => {
                            let image = this.images.findIndex(image => image.id === id)
                            this.images.splice(image, 1)
                        }).then(() => {
                            sweetAlert.fire(
                                'Deleted!',
                                'Your image was deleted.',
                                'success'
                            ).then(() => {
                                this.active = false
                                this.currentImage = {}
                            })
                        })
                    } else {
                        this.active = false
                        this.currentImage = {}
                    }
                })
            },
            updateImage (id) {
                this.currentImage = {}
                this.active = false
                let image = this.images.findIndex(image => image.id === id)
                axios.put('/admin/images/' + id, this.images[image]).then(({ data }) => {
                    this.images[image] = data.image
                    sweetAlert.fire(
                        'Updated',
                        data.message,
                        'success',
                    ).then(() => {
                        window.location.reload()
                    })
                })
            },
            imageSelected (image) {
                this.currentImage = image
                this.active = true
            },
            setActive (image) {
                this.imageSelected(image)
            },
            setCurrentPage (page) {
                this.pagination.current = page
                this.getImages()
            },
        },
        components: {
            'pagination': Pagination
        }
    }
</script>

<style scoped>

</style>