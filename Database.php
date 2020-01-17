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
        $sql = 'SELECT time,ip,referrer,user_agent,report_blocked_uri,report_disposition,report_document_uri,report_effective_directive,report_original_policy,report_referrer,report_script_sample,report_status_code,report_violated_directive FROM csp;';

        $result = $pdo->query($sql,PDO::FETCH_NUM);

        return $result->fetchAll();
    }
}
