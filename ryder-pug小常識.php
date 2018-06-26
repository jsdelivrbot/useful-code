<!-- with vue -->
a(:href="'https://maps.google.com?q=' + shop.address" target="_blank")

<!-- value給預設值 -->
.newsPagerWrap(data-page= (page) ? page:1)

<!-- 判斷class方法 -->
- var _now = 'news'

li.cell.shrink(class={'current': _now == 'news'}): a(href="news.html") NEWS

li.cell.shrink(class=(_now == 'news') ? 'current' : ''): a(href="news.html") NEWS