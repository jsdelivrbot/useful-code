<style lang="scss">
    @import "../sass/base";
    @import "../sass/public";

    .list{
        margin: 50px 0;
        li{
            @include mb(50px);
            padding-left: 50px;
        }
        .title{
            font-family: $content-family;
            font-size: 30px;
            color: red;
            margin-bottom: 20px;
        }
        .content{
            font-family: $content-family;
            letter-spacing: 1px;
            font-size: 20px;
            color: blue;
        }
    }
</style>

<template lang="html">
    <div>
        <ul class="list">
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, magnam.</li>
            <li>
                <div class="title">測試一下</div>
                <div class="content">來哈哈哈哈哈</div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: 'Helo, Vue.js 2.0'
            }
        }
    }
</script>