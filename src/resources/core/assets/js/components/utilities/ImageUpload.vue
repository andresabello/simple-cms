<template>
    <div class="image-upload-wrapper" v-show="active">
        <div class="modal" tabindex="-1" role="dialog" @click.self="close">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times-circle" @click="close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select-image-gallery @image-selected="setCurrentImage"></select-image-gallery>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <input type="file" @change="onFileChanged">
                                <img :src="'/' + image.url" class="img img-fluid"
                                     v-if="typeof image.url !== 'undefined' && image.url">
                            </div>

                            <div class="form-group">
                                <label for="caption">Caption</label>
                                <input type="text" id="caption" class="form-control" v-model="image.caption">
                            </div>

                            <div class="form-group">
                                <label for="alt">Alt</label>
                                <input type="text" id="alt" class="form-control" v-model="image.alt">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-outline-primary" type="submit">Update Image</button>
                                <button class="btn btn-primary text-white" type="button" @click="selectImage">Use Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SelectImageGallery from "./SelectImageGallery";

    export default {
        name: 'ImageUpload',
        data() {
            return {
                active: false,
                image: {
                    title: '',
                    url: null,
                    caption: '',
                    alt: '',
                },
            }
        },
        methods: {
            onFileChanged(event) {
                let file = event.target.files[0]
                let formData = new FormData()

                formData.append('title', file.name)
                formData.append('caption', this.image.url)
                formData.append('alt', this.image.alt)
                formData.append('file', file)

                axios.post('/admin/images', formData).then(({data}) => {
                    this.image = data.image
                })
            },
            close() {
                this.active = false
            },
            open() {
                this.active = true
            },
            setCurrentImage(image) {
                this.image = image
            },
            selectImage() {
                this.$emit('select-image', this.image)
                this.active = false
            }
        },
        components: {
            'select-image-gallery': SelectImageGallery
        }
    }
</script>

<style scoped lang="scss">
    .modal {
        display: block;
        background-color: rgba(0, 0, 0, .88);
        overflow-y: scroll;
    }
</style>