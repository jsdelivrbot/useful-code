import Vue from 'vue'
import test from '../components/test.vue'

new Vue({
	el: '#root',
	data: {
		message: "hello world",
		say: "fuck you"
	},
	components: {
		test
	}
})