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
    <link rel="shortcut icon" type="image/jpg" href="img/icon.jpg"/>
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
            <form action="registration.php" method="post">
            <div class="row no-gutters">
                <div class="col-12 login">
                    <h4>Zarejestruj się</h4>
                    <div class="mt-2">
                        <div>
                            <input class="login-field" name="userName" type="text" autocomplete="off"
                                   placeholder="Twoja nazwa użytkownika">
                        </div>
                        <div>
                            <input class="login-field" name="name" type="text" autocomplete="off"
                                   placeholder="Twoje imię">
                        </div>
                        <div>
                            <input class="login-field" name="email" type="text" autocomplete="off"
                                   placeholder="Twój ares email">
                        </div>
                        <div>
                            <input class="login-field" name="password" type="password" autocomplete="off"
                                   placeholder="Hasło - co najmniej 8 znaków, najlepiej litery, cyfry i znaki specjalne">
                        </div>
                        <div>
                            <input class="login-field" name="repeatPassword" type="password" autocomplete="off"
                                   placeholder="Powtórz hasło">
                        </div>
                        <button type='submit' class='login-field btn-primary' name='submit'>Dalej</button>
                        <!--<a href="registrationStep2.html" class="login-field btn-primary" id="next">Dalej</a>-->
                    </div>
                </div>
            </div>
            <div class="row no-gutters additional-actions">
                <a href="login.php" id="forget">Mam już konto, zaloguj</a>
            </div>
                <!--<button type="submit" name="submit">Zarejestruj się</button>-->
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {

                        echo"<p> Wypełnij wszystkie pola! </p>";
                    }
                    else if ($_GET["error"] == "invaliduid") {
                        echo"<p> Nieprawidłowa nazwa użytkownika! </p>";
                    }
                    else if ($_GET["error"] == "invalidemail") {
                        echo"<p> Nieprawidłowy adres email! </p>";
                    }
                    else if ($_GET["error"] == "passwordsdiffer") {
                        echo"<p> Hasła różnią się! </p>";
                    }
                    else if ($_GET["error"] == "usernametaken") {
                        echo"<p> Email lub nazwa użytkownika zajęte! </p>";
                    }
                }
                ?>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>



</body>
</html>