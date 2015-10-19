<?php

class Db{

    public static $pdo = null;
    public static $driver = null;
    public static $host = null;
    public static $user = null;
    public static $password = null;
    public static $base = null;

    static public function init(){

        if(self::$pdo === null){
            self::$pdo = new \PDO('mysql:host=127.0.0.1;dbname=wwwspendlivelyco_mim;charset=utf8', 'spendliv_mim', 'ha3Theej');
        }
        
        if(self::$pdo instanceof \PDO){
            return true;
        }
        
        return false;
    }

    public static function getPdo(){
        
        self::init();
        
        if(self::$pdo === null){
            self::init();
        }
        
        return self::$pdo;
    }
    
    public static function select_all($query, $mode = \PDO::FETCH_ASSOC){
        $pdo = self::getPdo();
        $dbh = $pdo->query($query);
        
        if(!$dbh){
            var_dump($query);
            return array();
        }
        
        if($dbh){
            $rows = $dbh->fetchAll($mode);
            if(!empty($rows) && $mode == \PDO::FETCH_ASSOC){
                foreach($rows as $r => $row){
                    foreach($row as $key => $value){
                        $key = strtolower($key);
                        $rows[$r][strtoupper($key)] = $value;
                        if(isset($rows[$r][$key])) unset($rows[$r][$key]);
                    }
                }
            }
            return $rows;
        }
    }
    
    public static function select($query){
        $pdo = self::getPdo();
        $dbh = $pdo->query($query);
        
        if(!$dbh){
            var_dump($query);
            return 0;
        }
        
        $result = $dbh->fetch($mode = \PDO::FETCH_COLUMN);
        return $result;
    }
    
    public static function query($query){
        $pdo = self::getPdo();
        $dbh = $pdo->query($query);
        
        if(!$dbh){
            var_dump($query);
            return false;
        }
        
        return $dbh->execute();
    }
}
