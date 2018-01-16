<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.6.1/Sortable.min.js"></script>

<div class="dragWrap grid-x">
	<div class="drag cell small-3">
		<ul class="dragList">
			<li class="flex-container align-center-middle" data-id="1">唐獎BANNER</li>
			<li class="flex-container align-center-middle" data-id="2">倒數計時</li>
			<li class="flex-container align-center-middle" data-id="3">唐獎影片</li>
			<li class="flex-container align-center-middle" data-id="4">獎項得獎人</li>
			<li class="flex-container align-center-middle" data-id="5">報名訊息</li>
			<li class="flex-container align-center-middle" data-id="6">新聞媒體</li>
			<li class="flex-container align-center-middle" data-id="7">唐獎大小事</li>
			<li class="flex-container align-center-middle" data-id="8">活動訊息</li>
			<li class="flex-container align-center-middle" data-id="9">影片專區</li>
		</ul>
	</div>

	<div class="drop cell auto">
		<ul class="dropList"><!-- js drag --></ul>
	</div>
</div>

<script>
	$(function () {
		Sortable.create($(".dragList").get(0), {
			animation: 100,
			group: {
				name: "drag",
				pull: true,
				put: ['drop'],
			},
		});

		var _sort = Sortable.create($(".dropList").get(0), {
			animation: 100,
			group: {
				name: "drop",
				pull: true,
				put: ['drag'],
			},
			onSort(e) {
				console.log(_sort.toArray())
			}
		});
	})
</script>