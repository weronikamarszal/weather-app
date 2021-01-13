<?php
require_once __DIR__ . '/../databaseConnection.php';
echo json_encode($_POST);


global $dbh;
$adverts = [];

try {
    $stmt = $dbh->prepare('INSERT INTO advertisements(name, description, more, picture, link, tag ) VALUES(:name, :description, :more, :image, :link, :tag)');
//    echo var_dump($stmt);
    $stmt->execute($_POST);
    $adverts = $stmt->fetchAll();
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

?>


