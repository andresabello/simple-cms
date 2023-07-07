<template>
    <a>
        <span class="icon is-medium"><i :class="icon"></i></span>
        <span>{{ name }}</span>
    </a>
</template>

<script>
export default {
	props: ['name', 'icon']
}
</script>
