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
                    <div class="py-4 my-3 text-center">
                        <button class="btn btn-dark" @click="addRow" type="button">
                            Add block &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                        </button>
                    </div>

                    <draggable :list="form.rows" ghost-class="ghost" handle=".row-handle" class="row my-4">
                        <div v-for="(row, index) in form.rows" class="mb-4 row-wrapper p-4 bg-white border w-100">
                            <div class="row mb-3">
                                <div class="col-xl-4">
                                    <div class="icon-wrapper d-inline-block">
                                        <i class="fas fa-arrows-alt row-handle"></i>
                                    </div>
                                </div>
                                <div class="col-xl-4 offset-xl-4">
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
                                                    <div class="tools w-100">
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

                                                        <div class="row mb-3">
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

                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <div class="option-type p-4 text-center"
                                                                     @click="setColumnType(column,'slider')">
                                                                    <i class="fas fa-images fa-2x d-block mb-3"></i>
                                                                    <div>Slider</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <!--                                                            <div class="option-type p-4 text-center"-->
                                                                <!--                                                                 @click="setColumnType(column,'code')">-->
                                                                <!--                                                                <i class="fas fa-code fa-2x d-block mb-3"></i>-->
                                                                <!--                                                                <div>Code</div>-->
                                                                <!--                                                            </div>-->
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
                                            <prism-editor :code="column.content"
                                                          v-model="column.content"></prism-editor>
                                        </div>

                                        <div class="slider-wrapper"
                                             v-if="column.type === 'slider' && typeof column.content !== 'undefined'">
                                            <input type="file" @change="onUploadSliderImage" :data-row="index"
                                                   :data-column="columnIndex">
                                            <div class="slides" v-if="column.slider_images.length > 0">
                                                <draggable :list="column.slider_images" ghost-class="ghost" handle=".slide">
                                                    <div class="slide" v-for="image in column.slider_images">
                                                        <div class="remove-image bg-danger py-1 px-2 rounded" @click="removeImage(index, columnIndex, image)">
                                                            <i class="fas fa-trash text-white"></i>
                                                        </div>
                                                        <img :src="'/' + image.url" :alt="image.title"
                                                             class="img img-fluid">
                                                    </div>
                                                </draggable>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </draggable>
                        </div>
                    </draggable>
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
                        <label>URL</label>
                        <input type="text"
                               class="form-control"
                               v-model="form.url"
                               :class="{'is-invalid': form.errors.has('url')}">
                    </div>
                    <div class="form-group mt-lg-5">
                        <label>Name</label>
                        <input type="text"
                               class="form-control"
                               v-model="form.name"
                               :class="{'is-invalid': form.errors.has('name')}">
                        <small class="form-text text-muted">
                            The name is used to generate links to the page
                        </small>
                    </div>
                    <div class="form-group mt-lg-5">
                        <label>Template</label>
                        <select class="form-control"
                                v-model="form.template"
                                :class="{'is-invalid': form.errors.has('template')}">
                            <option :value="option" v-for="option in templates" v-text="option"></option>
                        </select>
                    </div>
                    <div class="form-group mt-lg-5">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Order</label>
                                <select class="form-control"
                                        v-model="form.order"
                                        :class="{'is-invalid': form.errors.has('order')}">
                                    <option :value="option.value" v-for="option in orderOptions"
                                            v-text="option.label"></option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Page</label>
                                <select class="form-control"
                                        v-model="form.page"
                                        :class="{'is-invalid': form.errors.has('page')}">
                                    <option :value="option.id" v-for="option in pages" v-html="option.name"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-lg-5">
                        <p>
                            Hide Page from Navigation
                            <small class="form-text text-muted">
                                Checking this will hide the Page from the Navigation. Can only be applied to pages
                                without Children
                            </small>
                        </p>
                        <label>
                            <input type="checkbox"
                                   v-model="form.hidden"
                                   :class="{'is-invalid': form.errors.has('hidden')}">&nbsp;&nbsp;Hidden?
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

import Form from '../classes/pi-forms.js'
import BlockBuilder from './mixins/BlockBuilder.js'
import {sweetAlert} from '../utilities/sweet-alert.js'

export default {
    name: 'EditPageForm',
    mixins: [BlockBuilder],
    props: {
        pages: {
            type: Array,
            default() {
                return [
                    {id: '', name: ''},
                ]
            },
        },
        page: {
            type: Object,
            default() {
                return {
                    title: '',
                    name: '',
                    url: '',
                    template: '',
                    lft: '',
                    depth: '',
                    content: '',
                    hidden: false,
                }
            },
        },
        templates: {
            type: Array,
            default() {
                return []
            },
        },
    },
    data() {
        return {
            orderOptions: [
                {label: '', value: ''},
                {label: 'before', value: 'Before'},
                {label: 'after', value: 'After'},
                {label: 'childOf', value: 'Child Of'},
            ],
            form: new Form({
                title: '',
                name: '',
                url: '/',
                Template: '',
                Order: '',
                PageOrder: '',
                hidden: false,
                image: null,
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
                            class: '',
                            slider_images: []
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
        isNew() {
            return typeof this.page.id === 'undefined' || this.page.id === ''
        }
    },
    created() {
        this.form.title = this.page.title
        this.form.name = this.page.name
        this.form.url = this.page.url
        this.form.template = this.page.template
        this.form.order = this.page.lft
        this.form.pageOrder = this.page.depth
        this.form.hidden = this.page.hidden

        if (typeof this.page.rows !== 'undefined' && this.page.rows.length && this.page.rows[0].columns.length) {
            this.form.rows = this.page.rows
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
                            class: '',
                            slider_images: []
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
        submitForm() {
            if (this.isNew) {
                this.form.post('/admin/pages').then(({data}) => {
                    sweetAlert.fire(
                        'Created',
                        data.message,
                        'success',
                    ).then(() => {
                        document.location.href = '/admin/pages/' + data.page.id + '/edit'
                    })
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            } else {
                this.form.put('/admin/pages/' + this.page.id).then(({data}) => {
                    sweetAlert.fire(
                        'Update',
                        data.message,
                        'success',
                    ).then(() => {
                        document.location.reload()
                    })
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }
        },
        removeImage(rowIndex, colIndex, image) {
            let column = this.form.rows[rowIndex].columns[colIndex]
            this.form.client.delete('/admin/columns/'+ column.id +'/images/' + image.id).then(({data}) => {
                let imageIndex = column.slider_images.findIndex((slide) => image.id === slide.id)
                column.slider_images.splice(imageIndex, 1)
            })
        }
    },
}
</script>

<style scoped lang="scss">
</style>
