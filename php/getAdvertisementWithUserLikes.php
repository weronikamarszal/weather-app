<?php
require_once __DIR__ . '/../PDO_databaseConnection.php';
global $dbh;

session_save_path(getcwd() . "/../tmp");
session_start();
$userId = $_SESSION["userid"];

try {
    $stmt = $dbh->prepare('SELECT a.id, a.name, a.description, a.more, a.picture, a.link, a.tag, COUNT(l.userId) likesCount FROM advertisements a LEFT JOIN (SELECT * from likes WHERE userId=:userId) l ON a.id=l.advertisementId GROUP BY a.id');
    $stmt->execute(["userId" => $userId]);
    $adverts = $stmt->fetchAll();
    echo(json_encode($adverts));
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

?>

