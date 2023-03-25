<?php

 function primeNo($num){
    $count = 0;
    for($i = 1; $i <= $num; $i++){
        if($num%$i == 0){
            $count++;
        }

    }
    if($count < 3){
        return 1;
    }else{
        return 0;
    }
 }

$res = [];
// $a = primeNo(14);
// if($a == 1){
//     echo 'prime num';
// }else{
//     echo 'not prime';
// }

for($x = 1; $x <= 1000; $x++){
    $a = primeNo($x);
    if($a == 1){
        $int = (string) $x;
        $intArr = str_split($int);
        $sum = array_sum($intArr);
        if($sum < 10){
            array_push($res, $x);
        }
    }
}
foreach($res as $i){
    echo $i.', ';
    // echo '<br/>';
}
// print_r($res);



?>