<template>
    <div class="select-wrapper row">
        <div v-for="option in options"
             @click="selected(option.key)"
             class="col-md">
            <div class="option" :class="{'active': selectedOption === option.key}">
                {{ option.label }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Select',
        props: {
            options: {
                type: Array,
                required: true,
                default() {
                    return [
                        {
                            key: 'a',
                            label: 'option a'
                        },
                        {
                            key: 'b',
                            label: 'option b'
                        },
                    ]
                },
            },
            selectedOption: {
                type: String,
                required: false,
                default() {
                    return null
                }
            }
        },
        methods: {
            selected(option) {
                this.selectedOption = option
                this.$emit('selected', this.selectedOption)
            },
        },
    }
</script>

<style scoped lang="scss">
    @import "../../../scss/variables";

    .select-wrapper {

        .option {
            background-color: lighten($grey, 40);
            margin-right: 20px;
            text-align: center;
            color: $blue;
            font-size: 1.25em;
            border-radius: 3px;
            padding: 20px;
            cursor: pointer;
            transition: background-color .5s ease-in-out;

            &:last-child {
                margin-right: 0;
                margin-bottom: 0;
            }

            &:hover, &.active {
                background-color: darken($grey, 20);
            }
        }
    }
</style>