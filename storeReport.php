<?php
/**
 * @author Pavel Břoušek <brousek@ics.muni.cz>
 * @author Pavel Vyskočil <Pavel.Vyskocil@cesnet.cz>
 */

define('FIELDS', ['blocked_uri','disposition','document_uri','effective_directive','original_policy','referrer','script_sample','status_code','violated_directive']);

$config = include('config.php');

$dsn = $config['database']['dsn'];
$user = $config['database']['user'];
$password = $config['database']['password'];

$allowedHosts = $config['allowed_hosts'];
$continue = false;
try {
    $pdo = new PDO($dsn, $user, $password);

    $params = [];
    $params['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $params['report'] = file_get_contents('php://input');
    $params['ip'] = $_SERVER['REMOTE_ADDR'];
    $params['referrer'] = $_SERVER['HTTP_REFERER'] ?? '';
    $report = @json_decode($params['report'], true);

    foreach ($allowedHosts as $host) {
        if (strstr($params['report'],$host)) {
            $continue = true;
        }
    }
    if (!$continue) {
        exit();
    }
    if ($report !== null && isset($report["csp-report"])) {
        $report = $report["csp-report"];
        foreach (FIELDS as $field) {
            $origField = str_replace('_', '-', $field);
            if (isset($report[$origField])) {
                $params['report_' . $field] = $report[$origField];
            }
        }
    }

    $sql = 'INSERT INTO csp ('.implode(',',array_keys($params)).') VALUES (?';
    for ($i = 0;$i < (count($params) - 1);$i++) {
        $sql .= ',?';
    }
    $sql .= ');';

    $query = $pdo->prepare($sql);
    $query->execute(array_values($params));
} catch (Exception $e) {
    echo 'Connection failed: ' . $e->getMessage();
    error_log($e->getMessage());
}
