<?php

$envData = function (){
    $data = fopen('.env','r');
    $arr =[];
    if($data){
        while($f = fgets($data)){
            $ff = $f;
            $ff = explode('=',$ff);
            $arr[trim($ff[0])] = trim($ff[1]);
        }
    }
    return $arr;
};
function env($par,$defaultPar = null){
    global $envData;
    foreach ($envData() as $key => $value) {
        if($key == $par){
            return $value;
        }
    }
    return $defaultPar;
}