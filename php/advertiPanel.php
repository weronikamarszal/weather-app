<?php?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Admin's ad panel</title>

    <link rel="stylesheet" href="../main.css">
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
    <a class="navbar-brand" href="#" style="flex:1">
        <img src="../img/icon.jpg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        <?php
echo "What's the weather?"
?>
    </a>
    <div class="navbar-actions">
        <a href="">
            Ustawienia
        </a>
        <button type="button" class="btn btn-outline-danger">Wyloguj się</button>
    </div>
</nav>

<!--===============================================MAIN==============================================================-->
<div class="container">
    <h1 class="text-center"><br>Zarządzanie reklamami</h1>
    <br>
    <div id="buttonContainer">
        <button type="button" class="btn btn-outline-primary btn-lg">Dodaj</button>
    </div>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="#">L.p.</th>
            <th scope="col">Status</th>
            <th scope="col">Tytuł</th>
            <th scope="col">Nazwa</th>
            <th scope="col" class="text-center">Opis</th>
            <th scope="col">Obrazek</th>
            <th scope="col">Link</th>
            <th scope="col">Polubienia</th>
            <th scope="col">Usuń</th>
            <th scope="col">Edytuj</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>X</td>
            <td>X</td>
            <td>X
            </td>
            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque varius orci at sem sodales, vel</td>
            <td>X</td>
            <td>X</td>
            <td>X</td>
            <td><img id="trashImg" src="../img/delete.png" onclick="myScript()"></td>
            <td><img id="editImg" src="../img/edit.png" onclick="myScript()"></td>

        </tr>
        </tbody>
    </table>

</div>

<!--===============================================FOOTER============================================================-->
<footer>
    <p>&copy; Danylo Arbuzov, Jerzy Grzelak, Weronika Marszał</p>
    <p> icons made by <a href="https://www.flaticon.com">flaticon</a></p>
</footer>

<script src="../js/adPanel.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>


</body>

</html>