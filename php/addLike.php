<?php

require_once __DIR__ . '/../PDO_databaseConnection.php';
global $dbh;

session_save_path(getcwd() . "/../tmp");
session_start();
$userId = $_SESSION["userid"];

try {
    $stmt = $dbh->prepare("INSERT INTO likes (userId, advertisementId) VALUES (:userId, :advertisementId)");
    $tab = ["advertisementId"=>$_GET["advertisementId"], "userId"=>$userId];
    echo json_encode($tab);
    $stmt->execute($tab);
    $like = $stmt->fetchAll();
    echo json_encode($like);

} catch (Exception $e) {
    throw new Exception($e->getMessage());
}