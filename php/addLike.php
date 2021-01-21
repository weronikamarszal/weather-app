<?php

require_once __DIR__ . '/../PDO_databaseConnection.php';
global $dbh;

session_save_path(getcwd() . "/../tmp");
session_start();
$userId = isset($_SESSION["userid"]) ? $_SESSION["userid"] : null;

try {
    $stmt = $dbh->prepare("INSERT INTO likes (userId, advertisementId) VALUES (:userId, :advertisementId)");
    $tab = ["advertisementId"=>$_GET["advertisementId"], "userId"=>$userId];
    $stmt->execute($tab);
    $like = $stmt->fetchAll();
    echo json_encode($like);

} catch (Exception $e) {
    throw new Exception($e->getMessage());
}