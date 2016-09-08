<!-- condition code-en -->
https://developer.yahoo.com/weather/documentation.html#codes
<!-- condition code-ch -->
http://www.programgo.com/article/46662114125/


<!-- jquery -->
http://www.jq22.com/yanshi227

<script src="js/jquery.simpleWeather.min.js"></script>

<div class="temperature"><span></span>°c</div>

<script>
  $(document).ready(function() {
    $.simpleWeather({
      woeid: '2306204',
      success: function(weather) {
        html = '<img src="weather/'+weather.code+'.png">';
        $(".temperature span").text(weather.alt.temp);
        $(".weatherImg").html(html);
      },
      error: function(error) {
        // alert('error');
      }
    });
  });
</script>