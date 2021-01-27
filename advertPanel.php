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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Admin's ad panel</title>
    <link rel="shortcut icon" type="image/jpg" href="img/icon.jpg"/>
    <link rel="stylesheet" href="main.css">
    <style>
        #trashImg{
            height:10%;
            width:40%;
        }
        #editImg{
            height:10%;
            width:30%;
        }
    </style>
</head>

<!--=================================================================================================================-->

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
        <a href='userPanel-data.php'>Panel użytkownika</a>
        <a href="index.php">Strona główna</a>
        <a href='logout.php' class='btn btn-outline-danger'>Wyloguj się</a>
    </div>
</nav>

<!--===============================================MAIN==============================================================-->
<div class="container">
    <h1 class="text-center"><br>Zarządzanie reklamami</h1>
    <br>
    <div id="buttonContainer">
        <button type="button" class="btn btn-outline-primary btn-lg" onclick="changeLocation()">Dodaj</button>
    </div>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="#">Tytuł</th>
            <th scope="col" class="text-center">Opis</th>
            <th scope="col" class="text-center">Więcej</th>
            <th scope="col">Obrazek</th>
            <th scope="col">Link</th>
            <th scope="col">Tag</th>
            <th scope="col">Polubienia</th>
            <th scope="col">Usuń</th>
            <th scope="col">Edytuj</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>

<!--===============================================FOOTER============================================================-->
<footer>
    <p>&copy; Danylo Arbuzov, Jerzy Grzelak, Weronika Marszał</p>
    <p> icons made by <a href="https://www.flaticon.com">flaticon</a></p>
</footer>

<script src="js/server.js"></script>
<script src="js/adPanel.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</body>

</html>