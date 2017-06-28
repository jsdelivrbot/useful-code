<?php
//Check if a number is prime 質數
function isPrime($num, $pf = null)
{
    if(!is_array($pf)) 
    {
        for($i=2;$i<intval(sqrt($num));$i++) {
            if($num % $i==0) {
                return false;
            }
        }
        return true;
    } else {
        $pfCount = count($pf);
        for($i=0;$i<$pfCount;$i++) {
            if($num % $pf[$i] == 0) {
                return false;
            }
        }
        return true;
    }
}
//Find Prime Factors 質因數
function primeFactors($num)
{
    //Record the base
    $base = intval($num/2);
    $pf = array();
    $pn = null;
    for($i=2;$i <= $base;$i++) {
        if(isPrime($i, $pn)) {
            $pn[] = $i;
            while($num % $i == 0)
            {
                $pf[] = $i;
                $num = $num/$i;
            }
        }
    }
    return $pf;
}
//var_dump(primeFactors($row_RecAuthorityC['a_1']));
?>