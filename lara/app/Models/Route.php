<?php
namespace Lara\App\Models;

class Route{

    public static function __callStatic($name, $arguments)
    {
        if($name == 'get'){
            return new self(...$arguments);
        }
    }
    public function __construct(...$arguments)
    {
        $path = $arguments[0];
        $params = $this->checkPath($path);
        if($params){
            if(is_array($params)){
                $this->getController($arguments[1],$params);
            }else{
                $this->getController($arguments[1]);
            }
        }
    }
    public function checkPath(string $path){
        $url = get('path');
        $path = ltrim($path,'/');
        $params = [];
        if($url && $path){
            $exUrl = explode("/",$url);
            $exPath = explode("/",$path);
            foreach ($exPath as $key=>$value) {
                if($value[0] == ':'){
                    if(!isset($exUrl[$key])){
                        return false;
                    }
                    $exPath[$key] = $exUrl[$key];
                    $params[] = $exUrl[$key];
                }
            }
            $url = implode('/',$exUrl);
            $path = implode('/',$exPath);
        }
        if($url != $path){
            return false;
        }
        if($params){
            return $params;
        }
        return true;
    }
    public function getController($controllerMethod,$params =[]){
            $ar2 = explode('@',$controllerMethod);
            $controller = $ar2[0];
            $method = $ar2[1];
            $classController = 'App\Controllers\\'.$controller;
            $Controller = new $classController;
            $res = $Controller->$method(...$params);
            if(is_array($res)){
                print json_encode($res);
            }elseif(is_string($res) || is_numeric($res)){
                print $res;
            }
            exit();
    }

}