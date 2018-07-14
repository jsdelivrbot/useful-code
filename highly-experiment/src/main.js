import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import App from './vue/App.vue'


import Myproducts from './vue/products.vue'
import Myabout from './vue/about.vue'
import NotFound from './vue/NotFound.vue'


import TweenMax from "gsap/TweenMax"
import VueScrollTo from "vue-scrollto"


Vue.use(VueScrollTo, {
	container: "body",
	duration: 1000,
	easing: "ease-out",
	offset: 0,
	cancelable: true,
	onStart: false,
	onDone: false,
	onCancel: false,
	x: false,
	y: true
})


Vue.use(Vuex)
Vue.use(VueRouter)


const router = new VueRouter({
	mode: 'history',
	base: '/bear/',
	routes: [{
		path: '/',
		name: 'index',
		component: Myproducts,
		// beforeEnter: (to, from, next) => {}
	}, {
		path: '/about',
		name: 'about',
		component: Myabout
	}, {
		path : "*",
		component: NotFound
	}]
})


router.beforeEach((to, from, next) => {

	var _now = to.name

	store.commit('setNow', _now)
	store.commit('topmenuToggle')

	if (_now == 'about') {
		document.body.classList.remove("is-gray")
	}else{
		document.body.classList.add("is-gray")
	}

	VueScrollTo.scrollTo("#app", 1000)

	next()
})


const store = new Vuex.Store({
	state: {
		topmenuShow: true,
		now: 'index'
	},
	mutations: {
		topmenuToggle: (state) => {
			state.topmenuShow = !state.topmenuShow
		},
		setNow: (state, data) => {
			state.now = data
		}
	},
	action: {},
	getters: {
		topmenuShow: (state) => state.topmenuShow,
		now: (state) => state.now,
	}
})


var app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
    store
})