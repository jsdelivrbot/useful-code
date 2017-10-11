<!-- basic -->
<script>
    window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    window.cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;
</script>

<!-- 對於不兼容的瀏覽器，可以使用兼容寫法： -->
<script>
    window.requestAnimFrame = (function() {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(calback) {
                window.setTimeout(callback, 1000 / 60);
            }
    })();

    window.cancelAnimFrame = (function() {
        return window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || window.oCancelAnimationFrame || window.msCancelAnimationFrame || window.clearTimeout;
    })();
</script>


<!-- requestanimationframe ease -->
<script>
    var startTime = null;
    var _from = 0;
    var _to = 500;

    // 從 js/jquery.easing.1.3.js 偷來的
    function easeOutQuad(t, b, c, d) {
        return -c *(t/=d)*(t-2) + b;
    };

    function Move(duration, timestamp) {

        var timestamp = timestamp || 0;

        if(!startTime) startTime = timestamp;

        var _curr = timestamp - startTime;

        var step = easeOutQuad(_curr, _from, _to, duration);

        var move_path = [
            ['M', 0, step],
            ['s', _w / 4, 30, _w / 2, -20],
            ['s', _w / 4, 20, _w / 2, 30],
            ['V', _h],
            ['H', 0],
        ];

        path.plot(move_path)

        if (_curr <= duration) {
            requestAnimationFrame(Move.bind(null, duration));
        }else{
            cancelAnimationFrame(Move);
        }
    }

    new Move('3000');
</script>


使用方法：

1.記錄當前時間startTime，作為動畫開始的時間。
2.請求下一幀，帶上回調函數。
3.下一幀觸發時，回調函數的第一個參數為當前的時間，再與startTime進行比較，確定時間間隔ellapseTime。
4.判斷ellapseTime是否已經超過事先設定的動畫時間time，如果超過，則結束動畫。
5.計算動畫屬性變化的差值differ = to – from，再確定在ellapseTime的時候應該變化多少step = differ / time * ellapseTime。
6.計算出現在應該變化到的位置Math.round(from + step)，並重新對樣式賦值。
7.繼續請求下一幀。

<script>
    function animate(element, name, from, to, time) {
        time = time || 800; // 默認0.8秒
        var style = element.style,
            startTime;

        function go(timestamp) {
            if (startTime === null) startTime = timestamp;
            var progress = timestamp - startTime;
            timeDiv.innerHTML += progress + '\t\t';
            count++;
            if (progress >= time) {
                style[name] = to + 'px';
                timeDiv.innerHTML += '<br>have do  ' + count + ' setting';
                return;
            }

            var now = (to - from) * (progress / time);
            style[name] = now.toFixed() + 'px';
            requestAnimationFrame(go);
        }

        style[name] = from + 'px';

        requestAnimationFrame(go);
    }

    animate(document.getElementById('demo'), 'left', 0, 400, 1000);
</script>