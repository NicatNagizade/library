<?php
namespace Lara\App\Models;

class Language{
    public static $words = [];
    public static $language;

    public static function setLanguage(string $language = 'en'){
        static::$words = require_once base_path("resources/lang/$language.php");
    }
    public static function lang(string $par, array $params = []):string{
        $res = static::$words[$par];
        if($params){
            $exps = explode(' ',$res);
            foreach ($exps as $key=>$exp) {
                if($exp[0] == ':'){
                    foreach ($params as $p_key => $p_value) {
                        if(ltrim($exp,':') == $p_key){
                            $exps[$key] = $p_value;
                        }
                    }
                }
            }
            $res = implode(' ',$exps);
        }
        return $res;
    }
}