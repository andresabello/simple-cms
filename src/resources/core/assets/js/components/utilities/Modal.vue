<template>
    <div class="pi-modal" v-if="active" @click.self="hide">
        <div class="modal" tabindex="-1" role="dialog" @click.self="hide">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <slot name="header"></slot>
                        <button type="button" class="close" aria-label="Close" @click="hide">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot name="content"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'pi-modal',
        props: {
            'active': {
                type: Boolean,
                default: false,
                required: true
            }
        },
        methods: {
            hide () {
                this.$emit('hide')
            }
        }
    }
</script>

<style scoped lang="scss">
    .pi-modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .87);
        z-index: 99999;

        .modal {
            display: block;
            position: absolute;
            overflow-y: scroll;
        }
    }
</style>