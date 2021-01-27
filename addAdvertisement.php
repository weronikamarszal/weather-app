<?php
session_save_path(getcwd() . "/tmp");
session_start();
if(isset($_SESSION["userid"])){
    $name=$_SESSION["firstname"];
    $username=$_SESSION["username"];
    $email=$_SESSION["email"];
    $role=$_SESSION["role"];
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/jpg" href="img/icon.jpg"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="login.css">
    <title>Admin's ad panel</title>

    <link rel="stylesheet" href="main.css">
</head>

<body>
<!--===============================================HEADER============================================================-->
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="index.php" style="flex:1">
        <img src="img/icon.jpg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        What's the weather?
    </a>
    <?php
    if(isset($_SESSION["userid"])) {
        echo "<p style='position:relative;bottom:-6px;'>Witaj, $name </p>";
    }
    ?>
    <div class="navbar-actions">
        <?php
        if(isset($_SESSION["userid"])) {
            if ($role == "admin") {
                echo "<a href='userManaging.php'>Zarządzanie użytkownikami</a>";
                echo "<a href='addAdvertisement.php'>Dodaj reklamę</a>";
            }
        }
        ?>
        <a href="index.php">Strona główna</a>
        <a href='logout.php' class='btn btn-outline-danger'>Wyloguj się</a>
    </div>
</nav>


<div class="container">
    <div class="row no-gutters">
        <div class="col-md-3"></div>
        <div class="col-md-6 login-container">
            <div class="row no-gutters">
                <div class="col-12 login">
                    <h4>Dodaj reklamę</h4>
                    <div class="mt-2">
                        <form id="addAdvertisementForm">
                        <div>
                            <input class="login-field" id="name" name="name" type="text" autocomplete="off"
                                   placeholder="Nazwa reklamy">
                        </div>
                        <div>
                            <input class="login-field"id="description" name="description" type="text" autocomplete="off"
                                   placeholder="Opis">
                        </div>
                        <div>
                            <input class="login-field" id="more" name="more" type="text" autocomplete="off"
                                   placeholder="Więcej">
                        </div>
                        <div>
                            <input class="login-field" id="picture" name="picture" type="text" autocomplete="off"
                                   placeholder="Zdjęcie">
                        </div>
                        <div>
                            <input class="login-field" id="link" name="link" type="text" autocomplete="off"
                                   placeholder="Link">
                        </div>
                        <div>
                            <select required name="tag" class="login-field" id="tag" autocomplete="off"
                                    >
                                <option disabled selected>Tag</option>
                                <option value="COLD">COLD</option>
                                <option value="HOT">HOT</option>
                                <option value="RAIN">RAIN</option>
                            </select>
                        </div>
                        <div>
                            <input type="submit"/>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>



<!--===============================================FOOTER============================================================-->
<footer>
    <p>&copy; Danylo Arbuzov, Jerzy Grzelak, Weronika Marszał</p>
    <p> icons made by <a href="https://www.flaticon.com">flaticon</a></p>
</footer>

<script src="addAdvertisement.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>


</body>

</html>