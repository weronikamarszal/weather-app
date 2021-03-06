<?php
function emptyInputSignup($name,$email,$userName,$password,$repeatPassowrd){
    if( empty($name) ||empty($userName)||empty($email)||empty($password)||empty($repeatPassowrd)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}
function invalidUid($userName){

    if (!preg_match("/^[a-zA-Z0-9]*$/",$userName)) {
        $result=false;
    }
    else{
        $result=false;
    }
    return $result;
}
function invalidEmail($email){

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}
function pwdMatch($password,$repeatPassword){
    if ($password!==$repeatPassword) {
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}
function uidExists($conn,$userName,$email){
    $sql="SELECT * FROM users WHERE userName=? OR userEmail=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ./index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$userName,$email);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function emptyInputLogin($userName,$password){
    if(empty($userName)||empty($password)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function createUser($conn,$userName,$name,$email,$password){
    $key=md5(time().$userName);
    $role="user";
    $sql="INSERT INTO users (userName,userFirstName,userEmail,userPassword,role,vkey) VALUE (?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ./index.php?error=stmtfailed");
        exit();
    }
    $hashedPwd=password_hash($password,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"ssssss",$userName,$name,$email,$hashedPwd,$role,$key);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    setcookie("email",$email);
    setcookie("vkey",$key);
    header("location: ./registrationStep2.php");
}

function loginUser($conn,$userName,$password){
    $uidExists=uidExists($conn,$userName,$userName);
    if($uidExists===false){
        header("location: ./login.php?error=wronglogin");
        exit();
    }
    $_SESSION["verified"]=$uidExists["isVerified"];
    if(!($_SESSION["verified"]==1)){
        header("location: ./login.php?error=notverifieduser");
        exit();
    }
    $pwdHashed=$uidExists["userPassword"];
    $checkPwd=password_verify($password,$pwdHashed);
    if($checkPwd===false){
        header("location: ./login.php?error=wrongpassword");
        exit();
    }
    else if($checkPwd===true){
        session_save_path(getcwd() . "/tmp");
        session_start();
        $_SESSION["username"]=$uidExists["userName"];
        $_SESSION["firstname"]=$uidExists["userFirstName"];
        $_SESSION["email"]=$uidExists["userEmail"];
        $_SESSION["userid"]=$uidExists["userId"];
        $_SESSION["role"]=$uidExists["role"];
        header("location: ./index.php");
        exit();
    }
}

