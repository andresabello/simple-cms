<template>
    <div class="tabs is-boxed is-fullwidth is-large">
        <ul>
            <li :class="{'is-active': tab.active}" @click="goTo(tab.url)" v-for="(tab, index) in tabs" :key="index">
                <pi-tab :name="index" :icon="tab.icon"></pi-tab>
            </li>
        </ul>
    </div>
</template>
<script>
import PiTab from './PiTab.vue'

export default {
	props: ['tabs'],

	data() {
		return {}
	},

	components: {
		'pi-tab': PiTab
	},
	methods: {
		setActive(uri) {
			this.tabs.map((tab, index) => {
				tab.active = false
				tab.active = uri.includes(index)
			})
		},

		goTo(url) {
			window.location.href = url
		}
	},
	beforeMount() {
		this.setActive(location.href)
	}
}
</script>
