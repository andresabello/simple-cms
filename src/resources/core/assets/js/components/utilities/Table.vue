<template>
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead v-if="headings.length > 0">
                <tr>
                    <th v-for="heading in headings" scope="col" v-text="heading.replace(/_/gi, ' ')"
                        class="table-heading"></th>
                    <th v-if="hasPaymentAction" v-text="paymentAction.label" class="text-center"></th>
                    <th v-if="hasActions" v-text="editAction.label" class="text-center"></th>
                    <th v-if="hasActions" v-text="deleteAction.label" class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in data" :key="item.id" class="table-row">
                    <td v-for="heading in headings" v-text="item[heading]"></td>
                    <td v-if="hasPaymentAction" class="text-center">
                        <i class="fa fa-shopping-cart" aria-hidden="true" @click="payRow(item)"></i>
                    </td>
                    <td v-if="hasActions" class="text-center">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" @click="editRow(item)"></i>
                    </td>
                    <td v-if="hasActions" class="text-center">
                        <i class="fa fa-trash-o" aria-hidden="true" @click="deleteRow(item)"></i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'pi-table',
        props: {
            data: {
                type: Array,
                default() {
                    return [
                        {
                            name: 'John Doe',
                            phone: '9999999',
                        },
                        {
                            name: 'Jane Doe',
                            phone: '9999999',
                        },
                        {
                            name: 'Jeanie Doe',
                            phone: '9999999',
                        },
                    ]
                },
            },
            editAction: {
                type: Object,
                default() {
                    return {
                        label: 'Editar',
                    }
                },
            },
            deleteAction: {
                type: Object,
                default() {
                    return {
                        label: 'Borrar',
                    }
                },
            },
            paymentAction: {
                type: Object,
                default() {
                    return {
                        label: 'Pagar',
                    }
                },
            },
            hasActions: {
                type: Boolean,
                default: false,
            },
            hasPaymentAction: {
                type: Boolean,
                default: false,
            },
        },
        methods: {
            editRow(item) {
                this.$emit('edit', item)
            },
            deleteRow(item) {
                this.$emit('remove', item)
            },
            payRow(item) {
                this.$emit('pay', item)
            },
        },
        computed: {
            headings() {
                if (this.data.length <= 0) {
                    return []
                }

                return Object.keys(this.data[0])
            },
            totalPaginationItems() {
                return this.data.length ? this.data.length / this.totalPaginationItems() : 0
            },
        },
        components: {
            'pagination': (resolve) => require(
                ['./Pagination.vue'],
                resolve,
            ),
        },
    }
</script>

<style scoped lang="scss">
    @import "../../../scss/variables";

    .table-heading {
        text-transform: capitalize;
    }

    .table-row {
        .fa {
            cursor: pointer;

            &:hover {
                opacity: .7;
            }

            &.fa-pencil-square-o {
                color: $primary;
            }

            &.fa-trash-o {
                color: $red;
            }

            &.fa-shopping-cart {
                color: darken($green, 5);
            }
        }
    }
</style>