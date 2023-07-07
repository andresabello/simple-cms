<template>
    <div class="item-wrapper row">
        <div class="col-md-12">
            <div class="accordion card">
                <div class="accordion-header card-header">
                    <div class="row">
                        <div class="col-8">
                            <slot name="header"></slot>
                        </div>
                        <div class="col-4">
                            <div class="pull-right">
                                <i class="fa"
                                   aria-hidden="true"
                                   :class="currentIcon"
                                   @click="toggleActive"></i>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="accordion-content" v-show="active">
                    <slot name="content"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'accordion',
        props: {
            active: {
                type: Boolean,
                default: false,
            },
            openendIcon: {
                type: String,
                default: 'fa-caret-down',
            },
            closedIcon: {
                type: String,
                default: 'fa-caret-up',
            },
        },
        computed: {
            currentIcon () {
                return this.active ? this.openendIcon : this.closedIcon
            },
        },
        methods: {
            toggleActive () {
                this.$emit('active-toggled')
            },
        },
    }
</script>

<style scoped lang="scss">

    .accordion {
        border: 0;
        margin-bottom: 20px;

        &:last-child {
            margin-bottom: 0;
        }

        .accordion-header {
            border-radius: 3px;
            padding: 10px;
            margin-bottom: 20px;
            border: 0;

            p {
                margin-bottom: 0;
            }
        }

        .accordion-content {
            padding: 20px;
        }
    }

    .card-body {
        padding: 0 20px;
    }
</style>