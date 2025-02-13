<?php

namespace App\Helpers;

use Dotenv\Dotenv;

class Config
{
    protected static $env = [];

    public static function load()
    {
        if (empty(self::$env)) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();
            self::$env = $_ENV;
        }
    }

    public static function get($key, $default = null)
    {
        self::load();
        return self::$env[$key] ?? $default;
    }
}
