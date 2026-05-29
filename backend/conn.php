<?php

require_once("config.php");

$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function ensureAssignedUserColumn(PDO $conn) {
    $stmt = $conn->query("SHOW COLUMNS FROM taken LIKE 'assigned_user'");
    $columnExists = $stmt && $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    if (!$columnExists) {
        $conn->exec("ALTER TABLE taken ADD COLUMN assigned_user INT DEFAULT NULL");
    }
}
