<?php
require_once __DIR__ . '/../PDO_databaseConnection.php';

global $dbh;
$id = $_GET['id'];
$insert = "INSERT INTO advertisements(name, description, more, picture, link, tag ) VALUES(:name, :description, :more, :picture, :link, :tag)";
$update = "UPDATE advertisements SET name = :name, description= :description, more= :more, picture= :picture, link= :link, tag= :tag WHERE id = :id";
try {
    $stmt = $dbh->prepare($id == null ? $insert : $update);
    $stmt->execute($_POST);
    $adverts = $stmt->fetchAll();
    echo json_encode($adverts);
} catch (Exception $e) {
    echo $e->getMessage();
//    throw new Exception($e->getMessage());
}

?>


