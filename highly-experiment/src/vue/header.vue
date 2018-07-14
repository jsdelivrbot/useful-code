<template lang="html">
    <header>
        <div class="hamburger-outWrap">
            <div class="hamburger cell shrink" :class="{'is-open': topmenuShow}" @click="topmenuToggle">
                <span class="item1"></span>
                <span class="item2"></span>
            </div>

            <transition name="fade">
                <div class="topmenuWrap" v-if="topmenuShow">
                    <ul class="topmenuList">
                        <li><router-link to="/">home</router-link></li>
                        <li><router-link to="/about">about</router-link></li>
                        <li>projects</li>
                        <li>contact</li>
                    </ul>
                </div>
            </transition>
        </div>
    </header>
</template>


<script>
    import {mapGetters, mapMutations} from 'vuex'

    export default {
        data() {
            return {}
        },
        computed: {
            ...mapGetters(['topmenuShow'])
        },
        methods: {
            ...mapMutations(['topmenuToggle'])
        }
    }
</script>