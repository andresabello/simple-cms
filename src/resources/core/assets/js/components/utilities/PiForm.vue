<template>
    <div class="row">
        <div class="col-md-12">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                <h1 v-if="title"> {{ title }}</h1>
                <div class="alert alert-danger" v-if="form.errors.has('message')">
                    <button class="delete"></button>
                    <a :href="form.errors.errors.message.link" class="is-link">
                        <strong>{{ form.errors.getMessage('message') }}</strong>
                    </a>
                </div>


                <div class="form-group"
                     v-for="(field, index) in currentFields"
                     :key="index">
                    <label v-if="field.type !== 'submit'">{{ field.trans }}</label>
                    <p class="input-group-append">
                        <input class="form-control"
                               :class="{'is-invalid': form.errors.has(index)}"
                               type="text"
                               :name="index"
                               v-model="form[index]"
                               v-if="field.type === 'text'">

                        <input class="form-control"
                               :class="{'is-invalid': form.errors.has(index)}"
                               type="password"
                               :name="index"
                               v-model="form[index]"
                               v-if="field.type === 'password'">

                        <input class="form-control"
                               :class="{'is-invalid': form.errors.has(index)}"
                               type="email"
                               :name="index"
                               v-model="form[index]"
                               v-if="field.type === 'email'">
                        <textarea class="form-control"
                                  :class="{'is-invalid': form.errors.has(index)}" :name="index"
                                  v-model="form[index]"
                                  v-if="field.type === 'textarea'"></textarea>

                        <input class="form-control"
                               :class="{'is-invalid': form.errors.has(index)}" type="checkbox"
                               :name="index"
                               v-model="form[index]"
                               v-if="field.type === 'checkbox'">

                        <input class="form-control"
                               :class="{'is-invalid': form.errors.has(index)}" type="radio"
                               :name="index"
                               v-model="form[index]"
                               v-if="field.type === 'radio'">
                        <input class="form-control"
                               :class="{'is-invalid': form.errors.has(index)}" type="number"
                               :name="index"
                               v-model="form[index]"
                               v-if="field.type === 'number'">
                    </p>

                    <p class="invalid-feedback"
                       v-text="form.errors.get(index)"
                       v-if="form.errors.has(index)"></p>
                </div>

                <button class="btn btn-primary" :disabled="form.errors.any()">
                    {{ currentFields.submit.trans }}
                </button>

                <div class="alert alert-success" v-show="success.active">
                    <button class="delete"></button>
                    <strong>{{ success.message }}</strong>
                </div>
            </form>
            <br>
        </div>
    </div>
</template>
<script type="text/babel">
    import Form from '../../classes/pi-forms'

    export default {
        data () {
            return {
                form: {},
                currentFields: {},
                success: {
                    active: false,
                    message: '',
                },
            }
        },

        props: ['fields', 'action', 'model', 'title'],

        methods: {
            onSubmit () {
                this.form.post(this.action).then((data) => {

                    this.setSuccessMessage(data.message)

                    setTimeout(() => {
                        this.success.active = false
                    }, 1000)

                    if (typeof data.url !== 'undefined') {
                        window.location.href = data.url
                    }

                }).catch(errors => console.log(errors))
            },

            setSuccessMessage (message) {
                this.success.active = true
                this.success.message = message
            },

            setFields (fields) {
                return typeof fields === 'object' ? Object.values(fields) : fields
            },
        },
        beforeMount () {
            let data = this.setFields(JSON.parse(this.fields))
            this.form = new Form(data)
            this.currentFields = JSON.parse(this.fields)
        },
    }
</script>
