<?php

namespace Database {

    require_once __DIR__ ."/../Utils/DotEnv.php";

    use Utils\DotEnv\DotEnv;

    class Connection{

        public static function connect(): ?\PDO {

            $dotenv = new DotEnv(__DIR__ . "/../.env");
            $dotenv->load();

            $host = getenv("host");
            $port = getenv("port");
            $user = getenv("user");
            $database = getenv("database");
            $password = getenv("password");

            try {
                $conn = new \PDO("mysql:host=$host:$port;dbname=$database", $user, $password);
            } catch(\PDOException $e){
                echo "Connection failed: " . $e->getMessage() . PHP_EOL;
                return null;
            }

            return $conn;
        }

    }
}