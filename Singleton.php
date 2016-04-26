<?php
//单一模式
class Singleton
{
    static private $_instance=null;

    private $config;

    static function getInstance($config){
        if(is_null(self::$_instance))
            self::$_instance = new Singleton($config);

        return self::$_instance;
    }

    private function __construct($config)
    {
        $this->config = $config;
    }

    function __get($name)
    {
        return $this->config[$name];
    }

}

$singleton = Singleton::getInstance(['db_name'=>'MyDb','db_host'=>'127.0.0.1','db_user'=>'root','db_password'=>'xxx']);

echo $singleton->db_name;


