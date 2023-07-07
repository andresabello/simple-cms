<template>
    <div class="container">
        <div class="col-xl-12">
            <div class="options-wrapper my-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item" v-for="tab in tabs">
                        <a class="nav-link"
                           :class="currentTab === tab ? 'active' : null" href="#"
                           @click="currentTab = tab">{{tab}}</a>
                    </li>
                </ul>
                <div class="options p-5">
                    <component v-bind:is="currentOptionsComponent" class="tab"></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MainOptionsForm from "./MainOptionsForm"
    import StyleOptionsForm from "./StyleOptionsForm"
    import VariableOptionsForm from "./VariableOptionsForm"

    export default {
        name: "OptionsWrapper",
        data() {
            return {
                currentTab: 'Main',
                tabs: ['Main', 'Variables', 'Styles']
            }
        },
        computed: {
            currentOptionsComponent() {
                return 'option-' + this.currentTab.toLowerCase()
            }
        },
        components: {
            'option-main': MainOptionsForm,
            'option-variables': VariableOptionsForm,
            'option-styles': StyleOptionsForm,
        }
    }
</script>

<style scoped>

</style>