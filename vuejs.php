<!-- transition mode="out-in" 會導致anchor link 失敗 -->
<transition @before-enter="beforeEnter" @enter="enter" @before-leave="beforeLeave" @leave="leave" :css="false">
	<router-view :class="{'is-blur': topmenuShow}"></router-view>
</transition>

<script>
	methods: {
		beforeEnter(el) {
			TweenMax.set(el, {
				opacity: 0
			});
		},
		enter(el, done) {
			TweenMax.to(el, .5, {
				opacity: 1,
				onComplete: done
			});
		},
		beforeLeave(el) {
			TweenMax.set(el, {
				opacity: 1
			});
		},
		leave(el, done) {
			TweenMax.to(el, .5, {
				opacity: 0,
				onComplete: done
			});
		}
	}
</script>

<!-- vue transition css -->
<style>
	.fade-enter-active, .fade-leave-active{
		transition: all .5s;
	}
	.fade-enter, .fade-leave-to{
		opacity: 0;
		min-height: 100%;
	}

	.fade-appear-class{
		opacity: 0;
	}
	.fade-appear-to-class{}
	.fade-appear-active-class{
		transition: all 1s;
	}
</style>

<!-- nl2br -->
<style>
	.content{
		white-space: pre-wrap;
	}
</style>

<!-- cheetsheet -->
https://vuejs-tips.github.io/cheatsheet/

<!-- 操作data沒有更新 -->
https://pjchender.blogspot.tw/2017/05/vue-vue-reactivity.html

<script src="https://unpkg.com/vue"></script>

<!-- pagination -->
<!-- page是網址的query (這裡用的是node + express) -->
.newsPagerWrap(data-page= (page) ? page:1)

<script>
	var news = new Vue({
		el: '#news',
		data: {
			posts: []
		},
		methods: {},
		filters: {},
		created() {
			$.ajax({
				type: 'GET',
				url: 'http://localhost:1337/news'
			}).done((data) => {
			    // pagination
			    let _total = data.length
			    let _limit = 1
			    let _nowPage = $(".newsPagerWrap").data("page")

			    if ($(".newsPagerWrap").data("page") >= 2) {
			    	this.posts = data.slice(_nowPage - 1, _nowPage - 1 + _limit)
			    }else{
			    	this.posts = data.slice(0, _limit)
			    }

			    // creat page
			    let _totalPage = Math.ceil(_total / _limit)

			    for (var i = 1; i <= _totalPage; i++) {
			    	$('<a href="/news/'+ i +'")>'+ padLeft(i, 2) +'</a>').appendTo($(".newsPager"))
			    }

			    $(".newsPager a").eq(_nowPage - 1).addClass("active")

			    $(".newsPager-controls .prev").attr("href", "/news/" + (_nowPage - 1))
			    $(".newsPager-controls .next").attr("href", "/news/" + (_nowPage + 1))

			    if (_nowPage < 2) {
			    	$(".newsPager-controls .prev").hide()
			    }
			    if (_nowPage >= _totalPage) {
			    	$(".newsPager-controls .next").hide()
			    }
			})
		},
		updated() {}
	})
</script>

<!-- component -->
<ul class="cartList" id="cart">
    <cart-item inline-template price="498">
    	<li class="row">
			<div class="columns large-3">
				<div class="pic image-2x"><img src="images/cart/cart-1.png"><img src="images/cart/cart-1@2x.png" width="100"></div>
				<div class="itemClose image-2x"><img src="images/cart/close.png"><img src="images/cart/close@2x.png" width="20"></div>
			</div>
			<div class="columns large-6">
				<div class="en">Sensibility x Literal</div>
				<div class="ch">感性 與 文字</div>
				<div class="note">NT.498/6入</div>
				<div class="countWrap">
					<span class="minor image-2x" @click="minor"><img src="images/cart/minor.png"><img src="images/cart/minor@2x.png" width="6"></span>
					<span class="num">{{num}}</span>
					<span class="add image-2x" @click="add"><img src="images/cart/add.png"><img src="images/cart/add@2x.png" width="6"></span>
				</div>
			</div>
			<div class="columns large-3">
				<div class="price">NT.{{sum}}</div>
			</div>
		</li>
    </cart-item>
    <cart-item inline-template price="698">
    	<li class="row">
    		<div class="columns large-3">
    			<div class="pic image-2x"><img src="images/cart/cart-2.png"><img src="images/cart/cart-2@2x.png" width="100"></div>
    			<div class="itemClose image-2x"><img src="images/cart/close.png"><img src="images/cart/close@2x.png" width="20"></div>
    		</div>
    		<div class="columns large-6">
    			<div class="en">Fantasy x Secreat</div>
    			<div class="ch">奇幻 與 秘密</div>
    			<div class="note">NT.698/10入</div>
    			<div class="countWrap">
    				<span class="minor image-2x" @click="minor"><img src="images/cart/minor.png"><img src="images/cart/minor@2x.png" width="6"></span>
    				<span class="num">{{num}}</span>
    				<span class="add image-2x" @click="add"><img src="images/cart/add.png"><img src="images/cart/add@2x.png" width="6"></span>
    			</div>
    		</div>
    		<div class="columns large-3">
    			<div class="price">NT.{{sum}}</div>
    		</div>
    	</li>
    </cart-item>
	<li class="row">
		<div class="columns large-6">
			<div class="total">Total.</div>
		</div>
		<div class="columns large-6">
			<div class="totalPrice">NT.{{total}}</div>
		</div>
	</li>
</ul>

<script>
	Vue.component('cart-item', {
		template: '#cart-item',
		props: ['price'],
		data: function () {
			return {
				num: 0,
			}
		},
		methods: {
			add: function () {
				this.num += 1;
				this.$parent.$emit('totalAdd', this.sum);
			},
			minor: function () {
				if (this.num > 0) {
					this.$parent.$emit('totalMinor', this.sum);
					this.num -= 1;
				}
			},
		},
		computed: {
			sum: function () {
				return this.num * this.price
			},
		}
	})

	new Vue({
		el: '#cart',
		data: {
			total: 0
		},
		created: function() {
			this.$on('totalAdd', function(value){
				this.total += value
			});

			this.$on('totalMinor', function(value){
				this.total -= value
			});
		}
	})
</script>


<!-- filter example -->
<div class="date">{{post.updatedAt | dateFormat}}</div>

<script>
	const regist = new Vue({
		el: '#regist',
		data: {},
		methods: {},
		filters: {
			dateFormat(v) {
				return (v.slice(0, 10)).replace(/-/g, '')
			}
		},
		computed: {},
		created() {},
		updated() {}
	})
</script>