<template lang="pug">
	#app
		div {{hello}}
		myComponent
</template>

<script>
	import myComponent from './test.vue';

	export default {
		data() {
			return {
				hello: 'hello world'
			}
		},
		components: {
			myComponent
		},
	}
</script>