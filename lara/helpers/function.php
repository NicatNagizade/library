<?php

use Lara\App\Models\View;

$envData = function () : array{
    $data = fopen('.env','r');
    $arr =[];
    if($data){
        while($f = fgets($data)){
            if(trim($f)){
                $f = explode('=',$f);
                $arr[trim($f[0])] = trim($f[1]);
            }
        }
    }
    return (array)$arr;
};
function env(string $par,string $defaultPar = null) : string{
    global $envData;
    foreach ($envData() as $key => $value) {
        if($key == $par){
            return (string)$value;
        }
    }
    return (string)$defaultPar;
}
function base_path(string $path):string{
    $path = ltrim($path,'/');
    $base = env('BASE_PATH');
    $base = ltrim($base,'/');
    return (string)$_SERVER['DOCUMENT_ROOT'].'/'.$base.'/'.$path;
}
function get(string $par):string{
    if(isset($_GET[$par])){
        return (string)$_GET[$par];
    }
    return '';
}
function post(string $par):string{
    if(isset($_POST[$par])){
        return (string)$_POST[$par];
    }
    return '';
}
function request(string $par):string{
    if(isset($_REQUEST[$par])){
        return (string)$_REQUEST[$par];
    }
    return '';
}
function cookie(string $par):string{
    if(isset($_COOKIE[$par])){
        return (string)$_COOKIE[$par];
    }
    return '';
}
function session(string $par):string{
    if(isset($_SESSION[$par])){
        return (string)$_SESSION[$par];
    }
    return '';
}
function view(string $path,array $parameters=[]){
    $path = str_replace('.','/',$path);
    $path = ltrim($path,'/');
    foreach ($parameters as $key => $value) {
        ${$key} = $value;
    }
    print View::getView($path);
}
function setLang(string $language){
    Lara\App\Models\Language::setLanguage($language);
}
function lang(string $word,array $params = []){
    return Lara\App\Models\Language::lang($word,$params);
}
function getBeetweens(string $start, string $end, string $string):array{
    $strings = explode($start,$string);
    $res = [];
    for($i=0;$i<count($strings); $i++){
        if($i == 0) continue;
        $s = explode($end,$strings[$i]);
        $res[] = $s[0];
    }
    return (array)$res;
}