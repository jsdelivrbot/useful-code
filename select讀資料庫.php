<select name="d_class2" id="d_class2">
	<?php
	do {
		?>
		<option value="<?php echo $row_RecNewsC['c_id']?>"<?php if (!(strcmp($row_RecNewsC['c_id'], $G_selected1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecNewsC['c_title']?></option>
		<?php
	} while ($row_RecNewsC = mysql_fetch_assoc($RecNewsC));
	$rows = mysql_num_rows($RecNewsC);
	if($rows > 0) {
		mysql_data_seek($RecNewsC, 0);
		$row_RecNewsC = mysql_fetch_assoc($RecNewsC);
	}
	?>
</select>

