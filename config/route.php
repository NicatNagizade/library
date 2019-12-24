<?php

use Lara\App\Models\Language;

$routes = [
    'web'
];

setLang('az');

foreach($routes as $inc){
    require_once base_path('routes/'.$inc.'.php');
}