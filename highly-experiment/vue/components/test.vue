<template lang="pug">
    div
        p {{ name }} haasd

        ul.test
            li 123
            li 123
            li
                span test
</template>

<style lang="sass" scoped>
    .test
        background-color: #eee
        li
            font-size: 50px
            color: red
            padding: 20px
            border-bottom: 1px solid green
            width: 200px
            height: 200px
            position: relative
            background-color: rgba(blue, 0.3)
            span
                position: absolute
                top: 50%
                left: 50%
                transform: translate(-50%,-50%)
</style>

<script>
    export default {
        // Options / Data
        data() {
            return {
                name : 'Tony'
            }
        },
        // props: [],
        // propsData: {},
        // computed: {},
        // methods: {},
        // watch: {},
        // Options / DOM
        // el () {},
        // template: '',
        // render () {},
        // Options / Lifecycle Hooks
        // beforeCreate () {},
        // created () {},
        // beforeMount () {},
        // mounted () {},
        // beforeUpdate () {},
        // updated () {},
        // activated () {},
        // deactivated () {},
        // beforeDestroy () {},
        // destroyed () {},
        // Options / Assets
        // directives: {},
        // filters: {},
        // components: {},
        // Options / Misc
        // parent: null,
        // mixins: [],
        // name: '',
        // extends: {},
        // delimiters: [ '{{ ', ' }}' ],
        // functional: false
    }
</script>