<?php
require_once 'databaseConnection.php';

$id = $_GET['id'];

$query = "DELETE FROM users WHERE userId = '$id'";
$result = mysqli_query($conn, $query) or die( mysqli_error($conn) );


header("Location: http://localhost:63342/weather-app/userManaging.php");