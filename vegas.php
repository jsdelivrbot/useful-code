<script src="js/vegas.min.js"></script>
<link rel="stylesheet" href="css/vegas.min.css">

<style>
    .banner{
        &.vegas-container{height: 100% !important;}
        .vegas-wrapper{@include flexBoxCenter(column);}
        .vegas-slide-inner{background-attachment: fixed;}
    }
</style>

<script>
    // 讓video支援mobile
    $.vegas.isVideoCompatible = function () {
        return true;
    }

    $(window).load(function  () {
        $(".banner").vegas({
            timer: false,
            delay: 5500,
            transitionDuration: 1800,
            slides: [
            { src: "images/slidernew1.jpg" },
            { src: "images/slidernew2.jpg" },
            { src: "images/slidernew3.jpg" },
            { src: "images/slidernew4.jpg" },
            {
                // src: '/img/slide2.jpg',
                video: {
                    src: [
                        'video/GOPR1484.MP4',
                    ],
                    loop: false,
                    mute: true
                }
            },
            ]
        });
    })
</script>

<!--=============================
=            pager            =
=============================-->
<script type="text/javascript">
    $(".fish li").click(function  () {
        var index=$(this).index();
        $(".banner").vegas('jump', index);
        vegaspager();
    })
    $(".banner").on("vegaswalk",function  () {
        vegaspager();
    })

    function vegaspager () {
        var t=$(".banner").vegas('current');
        $(".fish li).eq(t).addClass("active").siblings().removeClass("active");
    }
</script>


<!--==============================
=            controls            =
===============================-->
<div id="vegasSwitch">
    <div id="switch1">
        <div class="enModel1">Tang Prize</div>
        <div class="chModel1 tangWinner">唐獎獲獎人</div>
        <div class="enModel1 bigName">James P. Allison</div>
        <div class="chModel1"><span class="boxBorder">生技醫學獎  得主</span></div>
        <div class="indexNote"><img alt="" src="images/indexnote.png" width="185"></div>
        <div class="contentModel">T細胞在免疫系統扮演重要角色,然而它仰賴抗原呈現細胞或其他分子將外來或有害的抗原消化並且重新呈現成T細胞可以識別的抗原型態T細胞才得以活化。</div>
    </div>
    <div id="switch2" hidden>
        <div class="enModel1">Tang Prize</div>
        <div class="chModel1 tangWinner">唐獎設計概念</div>
        <div class="enModel1 bigName">Design Concepts</div>
        <div class="chModel1"><span class="boxBorder">唐獎獎牌  設計</span></div>
        <div class="indexNote"><img alt="" src="images/indexnote2.png" width="144"></div>
        <div class="contentModel">T細胞在免疫系統扮演重要角色,然而它仰賴抗原呈現細胞或其他分子將外來或有害的抗原消化並且重新呈現成T細胞可以識別的抗原型態T細胞才得以活化。</div>
    </div>
</div>


<script>
    $(".vegasNext").click(function  () {
        $("body").vegas('next');
        vegascontrols();
    })
    $(".vegasPrev").click(function  () {
        $("body").vegas('previous');
        vegascontrols();
    })

    function vegascontrols () {
        var t=$("body").vegas('current')+1;
        var effect=$("#vegasSwitch #switch"+t+"").siblings().fadeOut(200);
        $.when(effect).done(function() {
            $("#vegasSwitch #switch"+t+"").fadeIn(700);
        });
    }
</script>