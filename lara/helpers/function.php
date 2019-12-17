<?php

$envData = function (){
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
function base_path($path){
    $path = ltrim($path,'/');
    $base = env('BASE_PATH');
    $base = ltrim($base,'/');
    return $_SERVER['DOCUMENT_ROOT'].'/'.$base.'/'.$path;
}
function get($par){
    if(isset($_GET[$par])){
        return $_GET[$par];
    }
}
function post($par){
    if(isset($_POST[$par])){
        return $_POST[$par];
    }
}
function request($par){
    if(isset($_REQUEST[$par])){
        return $_REQUEST[$par];
    }
}
function cookie($par){
    if(isset($_COOKIE[$par])){
        return $_COOKIE[$par];
    }
}
function session($par){
    if(isset($_SESSION[$par])){
        return $_SESSION[$par];
    }
}
function view($path,array $parameters=[]){
    $path = str_replace('.','/',$path);
    $path = ltrim($path,'/');
    foreach ($parameters as $key => $value) {
        ${$key} = $value;
    }
    include base_path('resources/views/'.$path.'.php');
}
function setLang($language){
    Lara\App\Models\Language::setLanguage($language);
}
function lang($word){
    return Lara\App\Models\Language::lang($word);
}