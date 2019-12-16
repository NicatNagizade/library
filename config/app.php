<?php

$includes = [
    'lara/helpers/function',
    'vendor/autoload',
];

foreach ($includes as $inc) {
    require_once $inc.'.php';
}