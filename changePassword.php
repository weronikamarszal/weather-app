<?php

require_once 'databaseConnection.php';
session_save_path(getcwd() . "/tmp");
session_start();

$id = $_SESSION["userid"];
$password = $_POST['password'];
$passwordHashed = password_hash($password, PASSWORD_DEFAULT);

$query = "UPDATE users SET userPassword = '$passwordHashed' WHERE userId = '$id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
