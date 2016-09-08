<?php
if( !function_exists('json_encode') ){
    require('Services/JSON.php');
}
//sd_recordset2array將資料集轉換為陣列
function sd_recordset2array($rs){
    mysql_data_seek($rs, 0);
    $ar = array();
    if(mysql_num_rows($rs)){
        while($row = mysql_fetch_assoc($rs)){
            $obj = array();
            foreach($row as $key => $value){
                $obj[ $key ] = $value;
            }
            array_push($ar, $obj);
        }
        mysql_data_seek($rs, 0);
    }
    return $ar;
}
//sd_array2json將陣列轉換為JSON
function sd_array2json($ar){
    if( function_exists('json_encode') ){//		echo '<p>have json_encode fun</p>';
        return json_encode($ar);
    } else {
        $json = new Services_JSON();//		echo '<p>no json_encode fun, set new Sevrvices</p>';
        return $json->encode($ar);
    }
}

//sd_recordset2json 是將資料集轉換為JSON
function sd_recordset2json($rs){
    $ar = sd_recordset2array( $rs );	//sd_recordset2array將資料集轉換為陣列
    return sd_array2json( $ar );		//sd_array2json將陣列轉換為JSON
}
?>