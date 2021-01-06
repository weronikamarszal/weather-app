<?php
if (isset($_POST["submit"])){
    $userName=$_POST["userName"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $repeatPassword=$_POST["repeatPassword"];

    require_once 'databaseConnection.php';
    require_once 'functions.php';

    if(emptyInputSignup($userName,$name,$email,$password,$repeatPassword)!==false){
        header("location: /test2/registration2.php?error=emptyinput");
        exit();
    }
    if(invalidUid($userName)!==false){
        header("location: /test2/index.php?error=invaliduid");
        exit();
    }
    if(invalidEmail($email)!==false){
        header("location: /test2/index.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($password,$repeatPassword)!==false){
        header("location: /test2/index.php?error=passwordsdiffer");
        exit();
    }
    if(uidExists($conn,$userName,$email)!==false){
        header("location: /test2/index.php?error=usernametaken");
        exit();
    }
    createUser($conn,$userName,$name,$email,$password);
}
else{
    header("location: /test2/login.php");
}
