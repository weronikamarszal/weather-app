<?php

require_once __DIR__ . '/../databaseConnection.php';


global $dbh;

try {
    $stmt = $dbh->prepare('DELETE FROM advertisements WHERE id=:id');
//    echo var_dump($stmt);
    $stmt->execute($_GET);
    $adverts = $stmt->fetchAll();
    echo json_encode($adverts);

} catch (Exception $e) {
    throw new Exception($e->getMessage());
}




