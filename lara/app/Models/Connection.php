<?php
namespace Lara\App\Models;

use PDO;
use PDOException;

class Connection{
    public static function con():PDO{
        $db=null;
        $db_connection = env('DB_CONNECTION');
        $db_host = env('DB_HOST');
        $db_database = env('DB_DATABASE');
        $db_username = env('DB_USERNAME');
        $db_password = env('DB_PASSWORD');
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try{
            $db = new PDO($db_connection.':'.'host='.$db_host.';dbname='.$db_database,$db_username,$db_password,$options);
        }
        catch(PDOException $ex){
            print $ex->getMessage();
            exit();
        }
        return $db;
    }
}