<template>
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a :href="home.url" v-html="home.name"></a>
        </li>
        <li class="breadcrumb-item active" v-html="current"></li>
    </ul>
</template>

<script>
    export default {
        name: 'breadcrumbs',
        props: {
            home: {
                type: Object,
                required: true,
                default () {
                    return {
                        url: '/',
                        name: 'Home',
                    }
                },
            },
            current: {
                type: String,
                required: true,
                default: 'Settings',
            },
        },
    }
</script>

<style scoped lang="scss">
    .breadcrumb {
        margin: 40px 0;
        padding: 20px 0;
    }
</style>