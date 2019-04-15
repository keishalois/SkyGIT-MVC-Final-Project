<?php

class DB {
    
    private static $instance = NULL;

    //Singleton Design Pattern
    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db_host = ini_get('db_host');
        $db_name = ini_get('db_name');
        $db_user = ini_get('db_user');
        $db_password = ini_get('db_password');
                
        if(empty($db_host) || empty($db_name) ||  empty($db_user) || empty($db_password)) {        
            self::$instance = new PDO('mysql:host=localhost;dbname=fml_fp', 'root', '', $pdo_options);
        } else {
            self::$instance = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password, $pdo_options);
        } 
  
      }
      return self::$instance;
    }
}
