<template>
    <div class="row">
        <div class="col-xl-12">
            <form @submit.prevent="saveOptions">
                <div class="form-group row" v-for="option in form.options">
                    <label class="col-sm-2 col-form-label">{{option.name}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" v-model="option.value"
                               v-if="option.type === 'text'">

                        <div class="file-wrapper" v-if="option.type === 'image'">
                            <input type="file" @change="onFileChanged" :id="option.name">
                            <img :src="option.value" :alt="option.name" v-show="option.value !== null">
                        </div>

                        <verte v-model="option.value" model="hex" picker="square"
                               v-if="option.type === 'color'"></verte>

                        <textarea class="form-control" v-model="option.value"
                                  v-if="option.type === 'textarea'"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg mt-5">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    import Verte from "verte"
    import 'verte/dist/verte.css'
    import Form from "../../classes/pi-forms"
    import {sweetAlert} from "../../utilities/sweet-alert";

    export default {
        name: "MainOptionsForm",
        data() {
            return {
                form: new Form({
                    options: [
                        {
                            id: null,
                            name: 'Name',
                            type: 'text',
                            value: '',
                            image_id: null,
                        }
                    ]
                })
            }
        },
        mounted() {
            this.form.get('/admin/ajax/theme-options').then(({data}) => {
                if (data.options.length) {
                    this.form.options = data.options
                }
            })
        },
        methods: {
            onFileChanged(event) {
                let file = event.target.files[0]
                let url = URL.createObjectURL(file)
                let id = event.target.id
                let currentOption = this.form.options.find((option) => option.name === id)
                currentOption.value = url

                let formData = new FormData()
                formData.append('title', currentOption.name)
                formData.append('description', currentOption.name)
                formData.append('file', file)
                axios.post('/admin/images', formData).then(({data}) => {
                    currentOption.value = '/' + data.image.url
                }).catch(() => {
                    sweetAlert.fire(
                        'Error',
                        'Unable to upload image',
                        'error',
                    )
                })
            },
            saveOptions() {
                this.form.put('/admin/theme-options').then(({data}) => {
                    sweetAlert.fire(
                        'Saved',
                        data.message,
                        'success',
                    ).then(() => {
                        document.location.reload()
                    })
                })
            }
        },
        components: {
            Verte,
        }
    }
</script>

<style scoped>

</style>