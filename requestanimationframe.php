<!-- basic -->
<script>
    window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
</script>

<script>
    // 下面是由Paul Irish及其他贡献者放在GitHub Gist上的代码片段，用于在浏览器不支持requestAnimationFrame情况下的回退，回退到使用setTmeout的情况。当然，如果你确定代码是工作在现代浏览器中，下面的代码是不必的
    (function() {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
        }
        if (!window.requestAnimationFrame) window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() {
                callback(currTime + timeToCall);
            }, timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
        if (!window.cancelAnimationFrame) window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
    }());
</script>


使用方法：

1.记录当前时间startTime，作为动画开始的时间。
2.请求下一帧，带上回调函数。
3.下一帧触发时，回调函数的第一个参数为当前的时间，再与startTime进行比较，确定时间间隔ellapseTime。
4.判断ellapseTime是否已经超过事先设定的动画时间time，如果超过，则结束动画。
5.计算动画属性变化的差值differ = to – from，再确定在ellapseTime的时候应该变化多少step = differ / time * ellapseTime。
6.计算出现在应该变化到的位置Math.round(from + step)，并重新对样式赋值。
7.继续请求下一帧。

<script>
    function animate(element, name, from, to, time) {
        time = time || 800; // 默认0.8秒
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