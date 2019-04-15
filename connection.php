<?php

class DB {
    
    private static $instance = NULL;

    //Singleton Design Pattern
    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        
        $db_host = getenv('db_host');
        $db_name = getenv('db_name');
        $db_user = getenv('db_user');
        $db_password = getenv('db_password');
                
        if(empty($db_host) || empty($db_name) ||  empty($db_user) || empty($db_password)) {        
            self::$instance = new PDO('mysql:host=localhost;dbname=fml_fp', 'root', '', $pdo_options);
        } else {
            self::$instance = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password, $pdo_options);
        } 
  
      }
      return self::$instance;
    }
}
