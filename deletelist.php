<?php
require_once 'databaseConnection.php';

$id = $_GET['id'];

$query = "DELETE FROM users WHERE userId = '$id'";
$result = mysqli_query($conn, $query) or die( mysqli_error($conn) );
//try {
//    $query=$conn-> prepare("DELETE * FROM users WHERE id=:id");
//    $query->execute(array(':id' => $_GET['id']));
//}
//catch(Exception $e){
//    throw new Exception($e->getMessage());
//}

header("Location: http://localhost:63342/weather-app/userManaging.php");