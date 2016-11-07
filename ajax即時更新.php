<!-- 資料庫轉成json再去接 -->
<script>
	var $html;
	var $old=$("table").html();

	$.ajax({
		url: "ask_data.php",
		dataType:"json",
		success: function(res){
			$.each(res, function (i, val) {
				$html+="<tr align='center'>";
				$html+="<td>"+val.object+"</td>";
				$html+="<td>"+val.name+"</td>";
				$html+="<td>"+val.phone+"</td>";
				$html+="<td>"+val.quantity+"</td>";
				$html+="<td>"+val.ask_date+"</td>";
				$html+="<td>"+val.data_1+"</td>";
				$html+="<td>"+val.notes+"</td>";
				$html+="<td>"+val.status+"</td>";
				$html+="</tr>";
			})
		},
		complete: function (res) {
			$("table").html($old+$html);
		}
	});

	setTimeout(function () {
		_get_data();
		$html='';
	}, 3000);
</script>