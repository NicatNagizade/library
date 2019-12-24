<?php
namespace Lara\App\Models;

class DB{
    protected $db;
    protected $table;
    protected $where = null;
    protected $select = '*';
    protected $limit = null;
    protected $offset = null;
    public $attributes =[];
    private $key = 'id';
    public function setKey($key){
        $this->key = $key;
        return $this;
    }
    public function __construct(string $table = null)
    {
        $this->table = $table;
        $this->db = Connection::con();
    }
    public function __destruct()
    {
        $this->db = null;
    }
    public function getKey(){
        if(isset($this->attributes[$this->key]))
        return $this->attributes[$this->key];
    }
    public static function table(string $table){
        return new self($table);
    }
    private function selectQuery($fetchType){
        $data = $this->db->query("SELECT ".$this->select." FROM `".$this->table."`".$this->where.$this->limit.$this->offset)->$fetchType();
        return $data;
    }
    public function get(...$columns){
        $this->select(...$columns);
        $data = $this->selectQuery('fetchAll');
        return $data;
    }
    public function all(...$columns){
        return $this->get(...$columns);
    }
    public function first(...$columns){
        $this->select(...$columns);
        $data = $this->selectQuery('fetch');
        return $data;
    }
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
    public function __get($name){
        return $this->attributes[$name];
    }
    public function select(...$columns){
        if(count($columns) > 0){
            foreach ($columns as $value) {
                $res[] = $value;
            }
            $this->select = '`'.implode('`,`',$res).'`';
        }
        return $this;
    }
    public function save(){
        $db = $this->db;
        $table = $this->table;
        foreach ($this->attributes as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
            $sets[] = "`$key`='$value'";
        }
        $keys = implode('`,`',$keys);
        $values = implode("','",$values);
        if($this->getKey()){
            $set = implode(',',$sets);
            $db->exec("UPDATE $table set $set WHERE ".$this->key ."=". $this->getKey());
        }else{
            $db->exec("INSERT $table (`$keys`) values ('$values')");
        }
    }
    public function whereRaw(string $where){
        $this->where = 'WHERE '.$where;
        return $this;
    }
    public function where(...$params){
        $data = null;
        if(count($params) == 2){
            $data = '`'.$params[0].'`'.'='."'".$params[1]."'";
        }else{
            $data = '`'.$params[0].'`'.$params[1]."'".$params[2]."'";
        }
        if(!$this->where){
            $data = " WHERE ".$data;
        }else{
            $data = " AND ".$data;
        }
        $this->where .= $data;
        return $this;
    }
    public function whereOr(...$params){
        $data = null;
        if(count($params) == 2){
            $data = '`'.$params[0].'`'.'='."'".$params[1]."'";
        }else{
            $data = '`'.$params[0].'`'.$params[1]."'".$params[2]."'";
        }
        $data = " OR ".$data;
        $this->where .= $data;
        return $this;
    }
    public function find($id){
        $data = $this->where('id',$id)->first();
        if(!$data) return exit('Bele bir data yoxdu');
        foreach ($data as $key => $value) {
            $this->attributes[$key] = $value;
        }
        return $this;
    }
    public function limit(int $limit){
        $this->limit = " LIMIT ".$limit;
        return $this;
    }
    public function offset(int $offset){
        $this->offset = " OFFSET ".$offset;
        return $this;
    }
    public function create(array $params){
        $db = $this->db;
        $table = $this->table;
        foreach ($params as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }
        $keys = implode('`,`',$keys);
        $values = implode("','",$values);
        $db->exec("INSERT $table (`$keys`) values ('$values')");
    }
}