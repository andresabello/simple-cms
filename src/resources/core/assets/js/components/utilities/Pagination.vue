<template>
    <nav aria-label="..." class="my-5 pagination-wrapper ">
        <ul class="pagination justify-content-center" :class="{
            'pagination-lg': size === 'large',
            'pagination-sm': size === 'small',
        }">
            <li class="page-item" @click="onClickFirstPage" :disabled="isInFirstPage">
                <a class="page-link" href="#" tabindex="-1">First</a>
            </li>
            <li class="page-item" :disabled="isInFirstPage" @click="onClickPreviousPage">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item" v-for="page in pages" :key="page.name" :class="{
                'active': page.name === current
            }" :disabled="page.isDisabled" @click="onClickPage(page.name)">
                <a class="page-link" href="#">{{ page.name }}
                    <span class="sr-only" v-show="page.name === current">(current)</span>
                </a>
            </li>
            <li class="page-item" @click="onClickNextPage" :disabled="isInLastPage">
                <a class="page-link" href="#">Next</a>
            </li>
            <li class="page-item" @click="onClickLastPage" :disabled="isInLastPage">
                <a class="page-link" href="#">Last</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            maxVisibleButtons: {
                type: Number,
                required: false,
                default: 3
            },
            current: {
                type: Number,
                required: true,
                default: 1
            },
            totalPages: {
                type: Array,
                required: true,
                default: [1]
            },
            size: {
                type: String,
                default: 'large'
            }
        },
        computed: {
            startPage() {
                if (this.current === 1) {
                    return 1;
                }

                if (this.maxVisibleButtons >= this.totalPages.length) {
                    return 1
                }

                if (this.current === this.totalPages.length) {
                    return this.totalPages.length - this.maxVisibleButtons
                }

                return this.current - 1
            },
            pages() {
                const range = [];

                for (let i = this.startPage;
                    i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages.length);
                    i += 1) {
                    range.push({
                        name: i,
                        isDisabled: i === this.current
                    })
                }

                return range
            },
            isInFirstPage() {
                return this.current === 1;
            },
            isInLastPage() {
                return this.current === this.totalPages.length;
            },
        },
        methods: {
            onClickFirstPage() {
                this.$emit('changed', 1);
            },
            onClickPreviousPage() {
                this.$emit('changed', this.current - 1);
            },
            onClickPage(page) {
                this.$emit('changed', page);
            },
            onClickNextPage() {
                this.$emit('changed', this.current + 1);
            },
            onClickLastPage() {
                this.$emit('changed', this.totalPages.length);
            }
        }
    }
</script>

<style scoped lang="scss">
    .pagination-wrapper {
        overflow-x: auto;
    }
</style>