import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './vue/App.vue'
import home from './vue/home.vue'
import mytest from './vue/test.vue'
import NotFound from './vue/NotFound.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	base: '/bear/',
	routes: [{
		path: '/',
		component: home
	}, {
		path: '/test',
		component: mytest
	}, {
		path : "*",
		component: NotFound
	}]
})

var app = new Vue({
    el: '#app',
    render: h => h(App),
    router
})