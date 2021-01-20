<!DOCTYPE html>
<?php
require_once 'databaseConnection.php';
if(isset($_GET['vkey'])){
    $vkey=$_GET['vkey'];
    $sql="SELECT isVerified, vkey FROM users WHERE isVerified IS NULL OR vkey=? LIMIT 1;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ./index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$vkey);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($resultData)){
        $sql="UPDATE users SET isVerified=? WHERE vkey=? LIMIT 1;";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ./index.php?error=stmtfailed");
            exit();
        }
        $verification=1;
        mysqli_stmt_bind_param($stmt,"ss",$verification,$vkey);
        mysqli_stmt_execute($stmt);
    }
    else{
        echo "Nieprawidłowe lub już zweryfikowane konto!";
    }
    mysqli_stmt_close($stmt);
}
else{
    die("Coś poszło nie tak.");
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="main.css">
    <title>What's the weather?</title>
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#" style="flex:1">
        <img src="img/icon.jpg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        What's the weather?
    </a>

    <a href="index.php">
        Strona główna
    </a>
</nav>
<p></p>
<div class="container">
    <div class="row no-gutters">
        <div class="col-md-3"></div>
        <div class="col-md-6 login-container">
            <div class="row no-gutters">
                Hejka
            </div>

        </div>
        </form>
        <div class="col-md-3"></div>
    </div>
</div>


</body>
</html>