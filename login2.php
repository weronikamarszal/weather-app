<?php
if (isset($_POST["submit"])) {

    $userName=$_POST["userName"];
    $password=$_POST["password"];
    require_once 'databaseConnection.php';
    require_once 'functions.php';
    if(emptyInputLogin($userName,$password)!==false){
        header("location: /test2/login.php?error=emptyinput");
        exit();
    }
    loginUser($conn,$userName,$password);
}
else{
    header("location: /test2/login.php");
    exit();
}