<template>
    <form @submit.prevent="submitForm" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-xl-9 py-5">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text"
                           class="form-control"
                           v-model="form.title"
                           :class="{'is-invalid': form.errors.has('title')}">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text"
                           class="form-control"
                           v-model="form.slug"
                           :class="{'is-invalid': form.errors.has('slug')}">
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="text"
                           class="form-control"
                           v-model="form.website"
                           :class="{'is-invalid': form.errors.has('website')}">
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text"
                           class="form-control"
                           v-model="form.url"
                           :class="{'is-invalid': form.errors.has('url')}">
                </div>
                <div class="form-group">
                    <div class="py-4 mt-4 mb-4">
                        <label>Description</label>
                        <div class="editor-wrapper">
                            <jodit-vue v-model="form.description"
                                       :config="imageConfig"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="py-4 my-3 text-center">
                        <button class="btn btn-dark" @click="addRow" type="button">
                            Add block &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div v-for="(row, index) in form.rows" class="mb-4 row-wrapper p-4 bg-white border">
                        <div class="row mb-3">
                            <div class="col-xl-4 offset-xl-8">
                                <i class="fas fa-ellipsis-h float-right" @click="toggleRowActive(row)"></i>
                                <div class="buttons border" v-show="row.active">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div @click="addColumn(index)" class="btn btn-link">
                                                Add Column
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="btn btn-link" @click="toggleRowOptions(row)">Options</div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="btn btn-link" @click="removeRow(index)">
                                                Delete Block
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-options mb-3 bg-gray border p-3" v-show="row.options">
                            <div class="row">
                                <div class="col-xl-12">
                                    <i class="fas fa-times-circle float-right" @click="row.options = false"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4">
                                    <label>Font Color</label>
                                    <verte v-model="row.colorPicker.value" model="hex" picker="square"></verte>
                                </div>
                                <div class="col-xl-4">
                                    <label>Background Color</label>
                                    <verte v-model="row.bgPicker.value" model="hex" picker="square"></verte>
                                </div>
                                <div class="col-xl-4">
                                    <label>Class</label>
                                    <input type="text" v-model="row.class" class="form-control">
                                </div>
                            </div>
                        </div>

                        <draggable :list="row.columns" ghost-class="ghost" handle=".handle" class="row my-4">
                            <div v-for="(column, columnIndex) in row.columns"
                                 @mouseover="setCurrentColumn(index, columnIndex)" :class="{
                                        'col-xl-12': row.columns.length === 1,
                                        'col-xl-6': row.columns.length === 2,
                                        'col-xl-4': row.columns.length === 3,
                                        'col-xl-3': row.columns.length === 4,
                                        'col': row.columns.length !== 1 && row.columns.length !== 2 &&
                                        row.columns.length !== 3 && row.columns.length !== 4,
                                    }">
                                <div class="column-controls mb-4">
                                    <div class="icon-wrapper d-inline-block">
                                        <i class="fas fa-arrows-alt handle"></i>
                                    </div>
                                    <div class="icon-wrapper d-inline-block ml-3"
                                         @click="toggleColumnActive(column)">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </div>
                                    <div class="column-options mt-3 border"
                                         v-show="column.active">
                                        <div class="row">
                                            <div class="col-xl-12 mb-4">
                                                <label>Column type</label>
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <div class="option-type p-4 text-center"
                                                             @click="setColumnType(column, 'content')">
                                                            <i class="fas fa-file-alt fa-2x d-block mb-3"></i>
                                                            <div>Content</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="option-type p-4 text-center"
                                                             @click="setColumnType(column, 'image')">
                                                            <i class="fas fa-image fa-2x d-block mb-3"></i>
                                                            <div>Image</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="option-type p-4 text-center"
                                                             @click="setColumnType(column,'video')">
                                                            <i class="fas fa-video fa-2x d-block mb-3"></i>
                                                            <div>Video</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="option-type p-4 text-center"
                                                             @click="setColumnType(column,'code')">
                                                            <i class="fas fa-code fa-2x d-block mb-3"></i>
                                                            <div>Code</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 mb-4">
                                                <label>Class</label>
                                                <input type="text" v-model="column.class" class="form-control">
                                            </div>
                                            <div class="col-xl-12">
                                                <div @click="removeColumn(index, columnIndex)"
                                                     class="btn btn-danger">
                                                    Remove Column <i class="fas fa-trash-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="column.type !== null">
                                    <div class="editor-wrapper">
                                        <jodit-vue v-model="column.content"
                                                   :config="imageConfig"
                                                   :id="'editor-' + index + '-' + columnIndex"
                                                   v-if="column.type === 'content' && typeof column.content !== 'undefined'"/>
                                    </div>

                                    <div class="file-wrapper"
                                         v-if="column.type === 'image' && typeof column.content !== 'undefined'">
                                        <input type="file" @change="onFileChanged"
                                               :id="Math.random().toString(36).substring(7)"
                                               :data-row="index"
                                               :data-column="columnIndex"
                                               v-show="column.content === ''">
                                        <img :src="column.content" class="img img-fluid">
                                    </div>

                                    <div class="video-wrapper"
                                         v-if="column.type === 'video' && typeof column.content !== 'undefined'">
                                        Video Upload or Select
                                    </div>

                                    <div class="code-wrapper"
                                         v-if="column.type === 'code' && typeof column.content !== 'undefined'">
                                        <prism-editor :code="column.content" v-model="column.content"></prism-editor>
                                    </div>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
                <div class="py-4 my-3 text-center">
                    <button class="btn btn-dark" @click="addRow" type="button">
                        Add block &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="col-xl-3 py-5">
                <div class="sidebar bg-white p-4 border">
                    <button class="btn btn-primary mb-4 btn-large mx-auto" type="submit">
                        {{ isNew ? 'Publish' : 'Update' }}
                    </button>
                    <div class="form-group">
                        <label>Featured Image</label>
                        <img :src="'/' + form.image.url" class="img img-fluid" v-if="form.image.url">
                        <button class="btn btn-info d-block mt-3" type="button" @click="openImageUpload">Upload</button>
                        <image-upload ref="uploader" @select-image="setSelectedImage"></image-upload>
                    </div>
                    <div class="form-group">
                        <label>Client</label>
                        <input type="text"
                               class="form-control"
                               v-model="form.web_client"
                               :class="{'is-invalid': form.errors.has('client')}">
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import 'flatpickr/dist/flatpickr.css'
    import Form from '../classes/pi-forms.js'
    import flatPickr from 'vue-flatpickr-component'
    import BlockBuilder from './mixins/BlockBuilder.js'
    import ImageUpload from './utilities/ImageUpload.vue'
    import { sweetAlert } from '../utilities/sweet-alert.js'

    export default {
        name: 'EditItemForm',
        mixins: [BlockBuilder],
        props: {
            items: {
                type: Array,
                default () {
                    return [
                        {
                            id: '',
                            name: ''
                        },
                    ]
                },
            },
            item: {
                type: Object,
                default () {
                    return {
                        title: '',
                        url: '',
                        slug: '',
                        image: null,
                        body: '',
                        web_client: '',
                        website: '',
                        description: '',
                    }
                },
            },
        },
        data () {
            return {
                form: new Form({
                    title: '',
                    url: '',
                    slug: '',
                    image: { url: null },
                    body: '',
                    web_client: '',
                    website: '',
                    description: '',
                    rows: [{
                        options: false,
                        class: '',
                        columns: [
                            {
                                type: null, //content, image, video
                                content: '',
                                image_id: null,
                                video_id: null,
                                file_id: null,
                                class: ''
                            }
                        ],
                        colorPicker: {
                            active: false,
                            value: '#fff'
                        },
                        bgPicker: {
                            active: false,
                            value: '#fff'
                        }
                    }]
                }),
            }
        },
        computed: {
            isNew () {
                return typeof this.item.id === 'undefined' || this.item.id === ''
            }
        },
        created () {
            this.form.title = this.item.title
            this.form.url = this.item.url
            this.form.slug = this.item.slug
            this.form.description = this.item.description
            this.form.web_client = this.item.client
            this.form.website = this.item.website

            if (typeof this.item.image !== 'undefined' && this.item.image) {
                this.form.image.url = this.item.image.url
                this.form.image.alt = this.item.image.alt
                this.form.image.id = this.item.image.id
            }

            if (typeof this.item.rows !== 'undefined' && this.item.rows.length && this.item.rows[0].columns.length) {
                this.form.rows = this.item.rows
            } else {
                this.form.rows = [
                    {
                        active: false,
                        options: false,
                        class: '',
                        columns: [
                            {
                                type: null, //content, image, video, code
                                active: true,
                                content: '',
                                image_id: null,
                                video_id: null,
                                file_id: null,
                                class: ''
                            }
                        ],
                        colorPicker: {
                            active: false,
                            value: '#fff'
                        },
                        bgPicker: {
                            active: false,
                            value: '#fff'
                        }
                    }
                ]
            }
        },
        methods: {
            submitForm () {
                if (this.isNew) {
                    this.form.post('/admin/items').then(({ data }) => {
                        sweetAlert.fire(
                            'Created',
                            data.message,
                            'success',
                        ).then(() => {
                            document.location.href = '/admin/items/' + data.post.id + '/edit'
                        })
                    }).catch((error) => {
                        console.log(error.response)
                        // this.form.errors.record(error.response.data.errors)
                    })
                } else {
                    this.form.put('/admin/items/' + this.item.id).then(({ data }) => {
                        sweetAlert.fire(
                            'Update',
                            data.message,
                            'success',
                        ).then(() => {
                            document.location.reload()
                        })
                    }).catch((error) => {
                        console.log(error.response)
                    })
                }

            },
            openImageUpload () {
                this.$refs.uploader.open()
            },
            setSelectedImage (image) {
                this.form.image = image
                this.item.image = this.form.image
            }
        },

        components: {
            flatPickr,
            'image-upload': ImageUpload
        },
    }
</script>

<style scoped lang="scss">
    @import "../../scss/variables";

    .row-wrapper {
        background-color: #f8f8f8;

        .icon-wrapper {
            cursor: pointer;
            transition: opacity .3s ease-in-out;

            &:hover {
                opacity: .8;
            }
        }
    }

    .button-trigger {
        width: 50px;
        height: 50px;
        border-radius: 3px;
        cursor: pointer;
        border: 1px solid $grey-dark;
    }

    .file-wrapper {
        .img {
            max-height: 450px;
        }
    }
</style>
