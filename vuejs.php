https://cn.vuejs.org/v2/guide/

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