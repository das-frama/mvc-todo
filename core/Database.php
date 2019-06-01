<?php

namespace core;

class Database
{
    private static $_dbc;

    public static function dbc()
    {
        if (self::$_dbc === null) {
            self::$_dbc = new \PDO("mysql:host=127.0.0.1;dbname=todo", "root", "");
        }

        return self::$_dbc;
    }
}
