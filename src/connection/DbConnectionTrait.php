<?php
namespace App\Connection;

use PDO;

trait DbConnectionTrait
{

    public static $pdo;
    private static string $server = "localhost";
    private static string $user = "root";
    private static string $password = "";
    private static string $dbName = "task";



    private static function setDb(): void
    {
        self::$pdo =  new PDO("mysql:host=".self::$server.";dbname=".self::$dbName, self::$user, self::$password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDb()
    {
        if (self::$pdo === null){
            self::setDb();
        }
        return self::$pdo;

    }



}