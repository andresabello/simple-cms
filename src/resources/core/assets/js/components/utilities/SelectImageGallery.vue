<template>
    <div class="select-image-gallery">
        <div class="row">
            <div class="col-xl-4 mb-5" v-for="image in images">
                <div class="image-wrapper">
                    <div class="action-buttons d-block text-left">
                        <i class="fas fa-edit mr-1 x cursor-pointer" @click="image.active = true"></i>
                        <i class="fas fa-trash cursor-pointer" @click="removeImage(image.id)"></i>
                    </div>

                    <img :src="'/' + image.url" :alt="image.alt" class="img img-fluid mb-4 cursor-pointer"
                         @click="imageSelected(image)">

                    <form class="update-image p-4" v-show="image.active" @submit.prevent="updateImage(image.id)">
                        <i class="fas fa-times-circle float-right cursor-pointer" @click="image.active = false"></i>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" v-model="image.title" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Alt</label>
                            <input type="text" v-model="image.alt" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Caption</label>
                            <textarea rows="3" class="form-control" v-model="image.caption"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
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

    export default {
        name: "SelectImageGallery",
        data() {
            return {
                images: [
                    {
                        active: null,
                        title: '',
                        alt: '',
                        url: '',
                        caption: ''
                    }
                ],
                pagination: {
                    current: 1,
                    totalPages: [1],
                    perPage: 10,
                    total: 10,
                },
            }
        },
        created() {
            this.getImages()
        },
        methods: {
            getImages() {
                axios.get('/admin/images').then(({data}) => {
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
            removeImage(id) {
                axios.delete('/admin/images/' + id).then(() => {
                    let image = this.images.findIndex(image => image.id === id)
                    this.images.splice(image, 1)
                })
            },
            updateImage(id) {
                let image = this.images.findIndex(image => image.id === id)
                axios.put('/admin/images/' + id, this.images[image]).then(({data}) => {
                    this.images[image] = data.image
                })
            },
            imageSelected(image) {
                this.$emit('image-selected', image)
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

<style scoped lang="scss">
    @import "../../../scss/variables";

    .select-image-gallery {

        img {
            height: 120px;
        }

        .update-image {
            background-color: $grey-lightest;
        }
    }
</style>