<?php

require_once __DIR__ . '/../PDO_databaseConnection.php';
global $dbh;

session_save_path(getcwd() . "/../tmp");
session_start();
$userId = isset($_SESSION["userid"]) ? $_SESSION["userid"] : null;

try {
    $tab = ["advertisementId"=>$_GET["advertisementId"], "userId"=>$userId];

    $stmt = $dbh->prepare("SELECT * FROM likes WHERE userId = :userId AND advertisementId = :advertisementId");
    $stmt->execute($tab);
    $like = $stmt->fetchObject();
    if ($like) {
        throw new Exception("już polubiono");
    }

    $stmt = $dbh->prepare("INSERT INTO likes (userId, advertisementId) VALUES (:userId, :advertisementId)");
    $stmt->execute($tab);
    $like = $stmt->fetchAll();
    echo json_encode($like);

} catch (Exception $e) {
    throw new Exception($e->getMessage());
}