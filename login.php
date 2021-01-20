<!DOCTYPE html>
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
            <form action="login2.php" method="post">
            <div class="row no-gutters">
                <div class="col-12 login">
                    <h4>Logowanie</h4>
                    <div class="mt-2">
                        <div>
                            <input class="login-field" name="userName" type="text" autocomplete="off"
                                    placeholder="Nazwa użytkownika"></div>
                        <div>
                            <input class="login-field" name="password" type="password" autocomplete="off"
                                    placeholder="Hasło"></div>
                        <button type="submit" name="submit" class="login-field btn-primary" id="login">Zaloguj się</button>
                        <?php
                        function alert($msg) {
                            echo "<script type='text/javascript'>alert('$msg');</script>";
                        }
                        if(isset($_GET["error"])){
                            if($_GET["error"]=="emptyinput"){
                                echo"<p> Wypełnij wszystkie pola! </p>";
                            }
                            else if ($_GET["error"] == "wrongpassword") {
                                echo"<p> Nieprawidłowe hasło! </p>";
                            }
                            else if ($_GET["error"] == "wronglogin") {
                                echo"<p> Nieprawidłowa nazwa użytkownika! </p>";
                            }
                            else if ($_GET["error"] == "notverifieduser") {
                                echo"<p> Użytkownik niezweryfikowany! </p>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row no-gutters additional-actions">
                <a href="remindPassword.html" id="forget">Zapomniałeś hasła?</a>
                <a href="registration2.php" id="registration">Zarejestruj się</a>
            </div>
           <!-- <button type="submit" name="submit">Zaloguj się</button>-->
            </form>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>


</body>
</html>