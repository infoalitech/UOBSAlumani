<?php

class Config {
    private static $env = [];

    public static function loadEnv($file = "../.env") {
        if (!file_exists($file)) return;
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($key, $value) = explode("=", $line, 2);
            self::$env[trim($key)] = trim($value);
        }
    }

    public static function get($key) {
        return self::$env[$key] ?? null;
    }
}
Config::loadEnv();