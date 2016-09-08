<!-- jquery -->
<script type="text/javascript" src="js/jquery/1.11.1/jquery.min.js"></script>
<!-- supersized -->
<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/supersized.shutter.css" type="text/css" media="screen"/>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="js/supersized.shutter.min.js"></script>
<!-- bxslider -->
<script src="js/jquery.bxslider/jquery.bxslider.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.bxslider/jquery.bxslider.css">


<script type="text/javascript">

          jQuery(function($){

        $.supersized({

          // Functionality
          slideshow               :   1,      // Slideshow on/off
          autoplay        : 1,      // Slideshow starts playing automatically
          start_slide             :   1,      // Start slide (0 is random)
          stop_loop       : 0,      // Pauses slideshow on last slide
          random          :   0,      // Randomize slide order (Ignores start slide)
          slide_interval          :   4000,   // Length between transitions
          transition              :   1,      // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
          transition_speed    : 1000,    // Speed of transition
          new_window        : 1,      // Image links open in new window/tab
          pause_hover             :   0,      // Pause slideshow on hover
          keyboard_nav            :   1,      // Keyboard navigation on/off
          performance       : 1,      // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
          image_protect     : 1,      // Disables image dragging and right click with Javascript

          // Size & Position
          min_width           :   0,      // Min width allowed (in pixels)
          min_height            :   0,      // Min height allowed (in pixels)
          vertical_center         :   1,      // Vertically center background
          horizontal_center       :   1,      // Horizontally center background
          fit_always        : 0,      // Image will never exceed browser width or height (Ignores min. dimensions)
          fit_portrait          :   1,      // Portrait images will not exceed browser height
          fit_landscape     :   0,      // Landscape images will not exceed browser width

          // Components
          slide_links       : 'blank',  // Individual links for each slide (Options: false, 'num', 'name', 'blank')
          thumb_links       : 1,      // Individual thumb links for each slide
          thumbnail_navigation    :   0,      // Thumbnail navigation
          slides          :   [     // Slideshow Images
          
                          {image : 'images/index.jpg', title : '0'},
                          {image : 'images/index2.jpg', title : '1'},
                          {image : 'images/index3.jpg', title : '2'},

                        ],

          // Theme Options
          progress_bar      : 1,      // Timer for each slide
          mouse_scrub       : 0

        });
        });

</script>

<!-- 串資料庫 -->
<script>
	slides          :   [     // Slideshow Images
          
                          <?php $i=0 ;do{  ;?>
                          {image : '<?php echo $row_Recslide['file_link1'] ?>', title : '<?php echo $i ;$i++ ;?>' },
                          <?php }while($row_Recslide = mysql_fetch_assoc($Recslide))?>
                          // {image : 'slide/index/s2.jpg', title : '1' },
                          // {image : 'slide/index/s3.jpg', title : '2' },

                        ],
</script>


<!-- html -->
<div id="slogan_area">
	  <ul class="bxslider_top">
	    <li><img src="images/slogan.png" ></li>
	    <li><img src="images/slogan2.png"></li>
	    <li><img src="images/slogan3.png"></li>

	    <?php do{ ?>
	    <li><img src="<?php echo $row_Recslogan['file_link1'] ?>" width="424"></li>
	    <?php }while($row_Recslogan = mysql_fetch_assoc($Recslogan))?>
	  </ul>
	</div>
	
	<ul id="bx-pager">  
	    <li><a><img src="images/slide_dot.png"><img src="images/slide_dot2.png"></a></li>
	    <li><a><img src="images/slide_dot.png"><img src="images/slide_dot2.png"></a></li>
	    <li><a><img src="images/slide_dot.png"><img src="images/slide_dot2.png"></a></li>

	     <?php for($j=0;$j<$totalRows_Recslogan;$j++) {?>
	    <li><a><img src="img/slide_dot.png" width="11"><img src="img/slide_dot2.png" width="11"></a></li>
	    <?php } ?>
	</ul>
	
	<div class="index-area1"></div><!-- area1 end -->



<script>
	$(window).load(function() { 
	   
	    _slider_top = $('.bxslider_top').bxSlider({
	        mode: 'fade',
	        auto: false,
	        // pager: false,
	        speed:1000,
	        pause:4000,
	        pagerCustom: '#bx-pager',
	        // randomStart:true,
	        controls: false,
	        onSlideBefore: function(){
	        // do mind-blowing JS stuff here
	        //slogan_where();
	       }
	  });

	  //api.goTo(2);
	  //_slider_top.goToSlide(vars.current_slide);
	 
	  theme.afterAnimation = function() {  };

	  theme.beforeAnimation= function() {
	  if (api.options.progress_bar && !vars.is_paused) theme.progressBar(); //  Start progress bar
	      //alert('cool');
	     slideTitle=api.getField('title');
	     //alert(slideTitle);
	     //menu_change(slideTitle);
	      _slider_top.goToSlide(vars.current_slide);
	  };

	   $('#bx-pager li').find('a').mousedown(function(){

	      var _slide_now=$(this).parent().index()+1;
	      api.goTo(_slide_now);

	  });
	   
	});

</script>


<style>
	#slogan_area{
		position: absolute;
		z-index: 11;
		top: 50%;
		width: 810px;
		height: 235px;
	}
	#bx-pager{
		position: absolute;
		bottom: 0;
		right: 0;
		z-index: 11;
		li{float: left; margin-right: 11px;}
		li:last-child{ margin-right: 0px;}
		li a{
			cursor: pointer;
			img:nth-child(1){display:block;}
			img:nth-child(2){display:none;}
		}
		li a.active{
			img:nth-child(2){display:block;}
			img:nth-child(1){display:none;}
		}
	}
</style>
