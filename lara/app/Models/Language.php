<?php
namespace Lara\App\Models;

class Language{
    public static $words = [];
    public static $language;

    public static function setLanguage($language){
        static::$language = $language;
    }

    public function __construct()
    {
        $lang = static::$language ?: 'en';
        static::$words = require_once base_path("resources/lang/$lang.php");
    }
    public static function lang($par){
        return static::$words[$par];
    }
}