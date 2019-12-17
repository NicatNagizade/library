<?php

$includes = [
    'lara/helpers/function',
    'vendor/autoload',

    //sonda include olunanlar
    'config/route'
];
foreach ($includes as $inc) {
    require_once $inc.'.php';
}