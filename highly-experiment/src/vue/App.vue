<template lang="html">
	<transition appear appear-class="fade-appear-class" appear-to-class="fade-appear-to-class" appear-active-class="fade-appear-active-class">
		<div id="app">
			<Myheader></Myheader>

			<transition name="fade" mode="out-in">
				<router-view :class="{'is-blur': topmenuShow}"></router-view>
			</transition>

			<Myfooter :class="{'is-blur': topmenuShow}"></Myfooter>
		</div>
	</transition>
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