<template lang="html">
	<div id="app">
		<Myheader></Myheader>

		<transition name="fade">
			<router-view :class="{'is-blur': topmenuShow}"></router-view>
		</transition>

		<Myfooter :class="{'is-blur': topmenuShow}"></Myfooter>
	</div>
</template>

<script>
	import {mapGetters, mapMutations} from 'vuex'
	import Myheader from './header.vue'
	import Myfooter from './footer.vue'

	export default {
		data() {
			return {}
		},
		computed: {
		    ...mapGetters(['topmenuShow'])
		},
		components: {
			Myheader,
			Myfooter,
		},
		methods: {}
	}
</script>