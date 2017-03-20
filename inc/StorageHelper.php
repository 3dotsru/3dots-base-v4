<?php

class StorageHelper {
    private $storage = array();
    private static $_instance = null;

    private function __construct() {}
    protected function __clone() {}

    static public function getInstance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function set($k, $v)
    {
        self::getInstance()->storage[$k] = $v;
    }

    public function get($k)
    {
        if(isset(self::getInstance()->storage[$k])){
            return self::getInstance()->storage[$k];
        }else{
            return false;
        }
    }
}