import Vue from 'vue';
import MyApp from './components/test.vue';

new Vue({
    el: '#app',
    template: '<MyApp></MyApp>',
    components: {
        MyApp
    }
});