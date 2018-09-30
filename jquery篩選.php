<!-- mixItUp -->
https://github.com/patrickkunka/mixitup


<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.0/mixitup.min.js"></script>


<script>
	var mixer = mixitup('.projectsList', {
		animation: {
	        clampHeight: false,  //如果濾的時候高會跳一下
	    }
	});
</script>


<!-- es6 -->
<script>
	import mixitup from 'mixitup';

	var mixer = mixitup('.productsList');

	$("#mobile-cat-select").on("change", function () {
		mixer.filter($(this).val());
	})

	$(".productsCatList li").on("click", function () {
		$(this).addClass("current").siblings().removeClass("current");
	})
</script>


<ul class="productsCatList show-for-large grid-x align-center-middle">
	<li class="cell shrink current" data-filter="all"><a href="javascript:;">ALL</a></li>
	<li class="cell shrink" data-filter=".category-brand"><a href="javascript:;">BRAND IDENTITY</a></li>
	<li class="cell shrink" data-filter=".category-package"><a href="javascript:;">PACKAGING DESIGN</a></li>
	<li class="cell shrink" data-filter=".category-design"><a href="javascript:;">WEB DESIGN</a></li>
	<li class="cell shrink" data-filter=".category-illustation"><a href="javascript:;">ILLUSTATION</a></li>
</ul>

<div class="mobile-productsCatList hide-for-large">
	<select name="" id="mobile-cat-select">
		<option value="all">ALL</option>
		<option value=".category-brand">BRAND IDENTITY</option>
		<option value=".category-package">PACKAGING DESIGN</option>
		<option value=".category-design">WEB DESIGN</option>
		<option value=".category-illustation">ILLUSTATION</option>
	</select>
</div>

<ul class="productsList m-width grid-x large-up-2">
	<li class="cell mix category-brand"><a href="works.php">
        <div class="pic"><img src="images/products-1.jpg"></div>
        <div class="title"><span class="cat">BRAND</span>JIKAI</div>
        <div class="type">branding,idenity,package</div>
    </a></li>
	<li class="cell mix category-brand"><a href="works.php">
        <div class="pic"><img src="images/products-1.jpg"></div>
        <div class="title"><span class="cat">BRAND</span>JIKAI</div>
        <div class="type">branding,idenity,package</div>
    </a></li>
	<li class="cell mix category-package"><a href="works.php">
        <div class="pic"><img src="images/products-1.jpg"></div>
        <div class="title"><span class="cat">BRAND</span>JIKAI</div>
        <div class="type">branding,idenity,package</div>
    </a></li>
	<li class="cell mix category-design"><a href="works.php">
        <div class="pic"><img src="images/products-1.jpg"></div>
        <div class="title"><span class="cat">BRAND</span>JIKAI</div>
        <div class="type">branding,idenity,package</div>
    </a></li>
	<li class="cell mix category-design"><a href="works.php">
        <div class="pic"><img src="images/products-1.jpg"></div>
        <div class="title"><span class="cat">BRAND</span>JIKAI</div>
        <div class="type">branding,idenity,package</div>
    </a></li>
	<li class="cell mix category-design"><a href="works.php">
        <div class="pic"><img src="images/products-1.jpg"></div>
        <div class="title"><span class="cat">BRAND</span>JIKAI</div>
        <div class="type">branding,idenity,package</div>
    </a></li>
</ul>