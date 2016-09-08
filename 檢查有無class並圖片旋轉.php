<!-- 新招 -->
<script>
	if( $(this).attr("class").match(/active_sp/) ){
		$(this).removeClass("active_sp").next().fadeOut(300);
	}
</script>




<script>
	$('.brand-area3 li.ba3-li ul.ba3-slidenav .p-title').click(function() {
		var _check=$(this).next().hasClass('none');
		if(_check){
			$(this).next().removeClass('none').addClass('show');
			$(this).find('.img').addClass('rotate');
		}else{
			$(this).next().addClass('none').removeClass('show');
			$(this).find('.img').removeClass('rotate');
			$(this).find('.img').addClass('norotate');
		}
	});
</script>

<style>
	.norotate{
		transform:rotate(0deg);
		transition:transform 0.5s;
	}
	.rotate{
		transform:rotate(44deg);
		transition:transform 0.5s;
	}
</style>