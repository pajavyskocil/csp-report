<?php

class Database {

    public static function createPDO()
    {
        $config = include('config.php');

        $dsn = $config['database']['dsn'];
        $user = $config['database']['user'];
        $password = $config['database']['password'];
        try {
            $pdo = new PDO($dsn, $user, $password);
        } catch (Exception $e) {
            echo 'Connection failed: ' . $e->getMessage();
            error_log($e->getMessage());
        }
        return $pdo;
    }

    public static function getAll()
    {
        $pdo = self::createPDO();
        $sql = 'SELECT * FROM csp;';

        $result = $pdo->query($sql,PDO::FETCH_ASSOC);

        return $result->fetchAll();
    }
}
