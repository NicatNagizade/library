<?php

namespace Lara\App\Models;

class View{
    public static function getView($path){
        function viewPath($path){
            return base_path('resources/views/'.$path.'.php');
        }
        ob_start();
        include viewPath($path);
        $data = ob_get_contents();
        ob_end_clean();
        return $data;
    }
}