<?php
require_once __DIR__ . '/../PDO_databaseConnection.php';


global $dbh;
$adverts = [];

try {
    $stmt = $dbh->prepare('SELECT a.id, a.name, a.description, a.more, a.picture, a.link, a.tag, COUNT(userId) likesCount FROM advertisements a LEFT JOIN likes ON a.id=likes.advertisementId GROUP BY a.id');
//    echo var_dump($stmt);
    $stmt->execute($_POST);
    $adverts = $stmt->fetchAll();
    echo(json_encode($adverts));
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

?>

