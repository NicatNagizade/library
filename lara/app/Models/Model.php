<?php
namespace Lara\App\Models;

abstract class Model{
    protected $db;
    protected $table;
    public $attributes = [];
    protected $key = 'id';
    public function __construct(array $attributes =[])
    {
        $this->attributes = $attributes;
    }
    public static function db():DB{
        if($table = (new static)->table){
            return DB::table($table)->setKey((new static)->key);
        }else{
            $table = static::class;
            $name = explode('\\',$table);
            rsort($name);
            return DB::table($name[0])->setKey((new static)->key);
        }
    }
    public static function __callStatic($name, $arguments)
    {
        if(method_exists(new Db,$name) && !method_exists(new static,$name)){
            if(count($arguments) == 0){
                return static::db()->$name();
            }
            elseif(count($arguments) == 1){
                return static::db()->$name($arguments[0]);
            }else{
                return static::db()->$name(...$arguments);
            }
        }
    }
}