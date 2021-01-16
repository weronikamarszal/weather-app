<?php
require_once __DIR__ . '/../PDO_databaseConnection.php';

global $dbh;

try {
    $stmt = $dbh->prepare('INSERT INTO advertisements(name, description, more, picture, link, tag ) VALUES(:name, :description, :more, :picture, :link, :tag)');
    $stmt->execute($_POST);
    $adverts = $stmt->fetchAll();
    echo json_encode($adverts);
} catch (Exception $e) {
    echo $e->getMessage();
//    throw new Exception($e->getMessage());
}

?>


