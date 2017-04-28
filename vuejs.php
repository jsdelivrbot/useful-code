https://cn.vuejs.org/v2/guide/

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

<!-- basic -->
<li id="bigdog">
	<div class="item">入住犬數:</div>
	<div class="item"><span>{{ big }}隻大型犬, {{ small }}隻小型犬</span></div>
	<div class="rws-chooseWrap">
		<div class="box">
			<div class="text"><span class="num">{{ big }}</span>隻大型犬<BR>(25kg以上)</div>
			<div class="btnWrap">
				<span @click="bigminor" class="btn image-2x"><img src="images/rooms/minor.png"><img src="images/rooms/minor@2x.png" width="13"></span>
				<span @click="bigadd" class="btn image-2x"><img src="images/rooms/plus.png"><img src="images/rooms/plus@2x.png" width="13"></span>
			</div>
		 </div>
		 <div class="box">
			<div class="text"><span class="num">{{ small }}</span>隻小型犬<BR>(25kg以下)</div>
			<div class="btnWrap">
				<span @click="smallminor" class="btn image-2x"><img src="images/rooms/minor.png"><img src="images/rooms/minor@2x.png" width="13"></span>
				<span @click="smalladd" class="btn image-2x"><img src="images/rooms/plus.png"><img src="images/rooms/plus@2x.png" width="13"></span>
			</div>
		 </div>
		<div class="box close">關閉</div>
	</div>
</li>

<script src="https://unpkg.com/vue"></script>

<script>
	var bigdog = new Vue({
		el: '#bigdog',
		data: {
			big: 0,
			small: 0
		},
		methods: {
			bigadd: function () {
				this.big += 1;
			},
			bigminor: function () {
				if (this.big > 0) {
					this.big -= 1;
				}
			},
			smalladd: function () {
				this.small += 1;
			},
			smallminor: function () {
				if (this.small > 0) {
					this.small -= 1;
				}
			}
		}
	})
</script>