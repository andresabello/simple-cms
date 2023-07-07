import 'prismjs'
import Verte from 'verte'
import 'verte/dist/verte.css'
import 'jodit/build/jodit.min.css'
import {JoditVue} from 'jodit-vue'
import draggable from 'vuedraggable'
import PrismEditor from 'vue-prism-editor'
import 'prismjs/themes/prism-tomorrow.css'
import 'vue-prism-editor/dist/VuePrismEditor.css'

export default {
    data() {
        return {
            currentRow: null,
            currentColumn: null,
            currentColumnOptions: false,
            imageConfig: {
                uploader: {
                    url: '/admin/images',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    isSuccess: (response) => {
                        return response
                    },
                    process: (response) => {
                        return {
                            files: response.image,
                            path: response.image.file_path,
                            baseurl: response.image.url,
                            error: response.error,
                            message: 'Image Uploaded'
                        }
                    },
                    defaultHandlerSuccess: (event) => {
                        if (!event.files || typeof event.files === 'undefined') return
                        let file = event.files
                        let img = `<img src="/${file.url}" class="img img-fluid">`
                        this.form.rows[this.currentRow].columns[this.currentColumn].content = img + this.form.rows[this.currentRow].columns[this.currentColumn].content
                    }
                },
            },
            config: {
                height: 500,
                listAdvancedTypes: true,
                toolbarButtons: {
                    'moreText': {
                        'buttons': [
                            'bold',
                            'italic',
                            'underline',
                            'strikeThrough',
                            'subscript',
                            'superscript',
                            'fontFamily',
                            'fontSize',
                            'textColor',
                            'backgroundColor',
                            'inlineClass',
                            'inlineStyle',
                            'clearFormatting'],
                    },
                    'moreParagraph': {
                        'buttons': [
                            'alignLeft',
                            'alignCenter',
                            'formatOLSimple',
                            'alignRight',
                            'alignJustify',
                            'formatOL',
                            'formatUL',
                            'paragraphFormat',
                            'paragraphStyle',
                            'lineHeight',
                            'outdent',
                            'indent',
                            'quote'],
                    },
                    'moreRich': {
                        'buttons': [
                            'insertLink',
                            'insertImage',
                            'insertVideo',
                            'insertTable',
                            'emoticons',
                            'fontAwesome',
                            'specialCharacters',
                            'embedly',
                            'insertFile',
                            'insertHR'],
                    },
                    'moreMisc': {
                        'buttons': [
                            'undo',
                            'redo',
                            'fullscreen',
                            'print',
                            'getPDF',
                            'spellChecker',
                            'selectAll',
                            'html',
                            'help'],
                        'align': 'right',
                        'buttonsVisible': 2,
                    },
                },
            }
        }
    },
    methods: {
        addRow() {
            this.form.rows.push({
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
            })
        },
        removeRow(index) {
            this.form.rows.splice(index, 1)
        },
        addColumn(rowIndex) {
            let row = this.form.rows[rowIndex]
            row.active = false

            if (row.columns.length >= 4) return

            this.form.rows[rowIndex].columns.push({
                type: null,
                active: true,
                content: '',
                codeLanguage: null
            })
        },
        toggleRowOptions(row) {
            row.active = false
            row.options = !row.options
        },
        toggleRowActive(row) {
            row.options = false
            row.active = !row.active
        },
        removeColumn(rowIndex, columnIndex) {
            if (this.form.rows[rowIndex].columns.length <= 1) return
            this.form.rows[rowIndex].columns = this.form.rows[rowIndex].columns.filter((column, index) => index !== columnIndex)
        },
        setCurrentColumn(row, column) {
            this.currentColumn = column
            this.currentRow = row
        },
        toggleColumnActive(column) {
            let active = column.active
            this.form.rows.forEach(row => row.columns.forEach(col => col.active = false))
            if (active === false) {
                column.active = true
            }
        },
        setColumnType(column, type) {
            column.type = type
            column.active = false
        },
        onFileChanged(event) {
            let file = event.target.files[0]
            let url = URL.createObjectURL(file)
            let row = event.target.dataset.row
            let column = event.target.dataset.column
            this.form.rows[row].columns[column].content = url

            let formData = new FormData()
            formData.append('title', url)
            formData.append('description', url)
            formData.append('file', file)
            window.axios.post('/admin/images', formData).then(({data}) => {
                this.form.rows[row].columns[column].image_id = data.image.id
            })
        },
        onVideoFileChanged(event) {
            let file = event.target.files[0]
            let url = URL.createObjectURL(file)
            let row = event.target.dataset.row
            let column = event.target.dataset.column
            this.form.rows[row].columns[column].content = url

            let formData = new FormData()
            formData.append('title', url)
            formData.append('description', url)
            formData.append('file', file)
            window.axios.post('/admin/videos', formData).then(({data}) => {
                this.form.rows[row].columns[column].image_id = data.image.id
            })
        },
        onUploadSliderImage(event) {
            let file = event.target.files[0]
            let url = URL.createObjectURL(file)
            let row = event.target.dataset.row
            let column = event.target.dataset.column

            let formData = new FormData()
            formData.append('title', url)
            formData.append('description', url)
            formData.append('file', file)
            window.axios.post('/admin/images', formData).then(({data}) => {
                this.form.rows[row].columns[column].slider_images.push(data.image)
            })
        },
    },
    components: {
        Verte,
        JoditVue,
        draggable,
        'prism-editor': PrismEditor
    },
}
