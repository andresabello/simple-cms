<template>
    <div class="variables-wrapper">
        <prism-editor :code="form.code" language="scss" v-model="form.code"></prism-editor>
        <button class="btn btn-primary btn-lg mt-5" @click="submitStyles">Save</button>
    </div>
</template>

<script>
    import "prismjs"
    import "prismjs/themes/prism-tomorrow.css"
    import Form from "../../classes/pi-forms"
    import PrismEditor from 'vue-prism-editor'
    import "vue-prism-editor/dist/VuePrismEditor.css"
    import {sweetAlert} from "../../utilities/sweet-alert";

    export default {
        name: "VariableOptionsForm",
        data() {
            return {
                form: new Form({
                    code: ''
                })
            }
        },
        mounted() {
            this.form.get('/admin/variables').then(({data}) => {
                this.form.code = data.code
            })
        },
        methods: {
            submitStyles() {
                if (this.form.code ==='') {
                    this.form.post('/admin/variables').then(({data}) => {
                        sweetAlert.fire(
                            'Created',
                            data.message,
                            'success',
                        ).then(() => {
                            document.location.reload()
                        })
                    })
                }else {
                    this.form.put('/admin/variables').then(({data}) => {
                        sweetAlert.fire(
                            'Updated',
                            data.message,
                            'success',
                        ).then(() => {
                            document.location.reload()
                        })
                    })
                }
            }
        },
        components: {
            'prism-editor': PrismEditor
        }
    }
</script>

<style scoped>

</style>