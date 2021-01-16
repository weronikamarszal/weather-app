<?php
require_once __DIR__ . '/../PDO_databaseConnection.php';


global $dbh;
$adverts = [];

try {
    $stmt = $dbh->prepare('SELECT * FROM advertisements');
//    echo var_dump($stmt);
    $stmt->execute($_POST);
    $adverts = $stmt->fetchAll();
    echo(json_encode($adverts));
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

?>


