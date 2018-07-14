<template lang="pug">
	#app
		div {{hello}}
		router-link(to="/") goto home
		router-link(to="/test") goto test

		.margin-top-5
			router-view
</template>

<script>
	export default {
		data() {
			return {
				hello: 'hello world123111'
			}
		},
		components: {},
	}
</script>