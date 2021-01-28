<?php
    session_save_path(getcwd() . "/tmp");
    session_start();
    if(isset($_SESSION["userid"])){
        $name=$_SESSION["firstname"];
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
    <title>What's the weather?</title>
    <link rel="shortcut icon" type="image/jpg" href="img/icon.jpg"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="advertisement.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <style>
        #mapid {
            height: 600px;
        }

        #chartContainer {
            margin: 0 auto;
            width: 800px;
            height: 600px
        }
        .search-box{
            width: 250px;
            height:40px;
        }

        @media only screen and (max-width: 700px) {
            .col-md-4 {
                width: 100%;
            }

            .mt-5 {
                position: relative;
                top: -15px;
            }

            #mapid {
                position: relative;
                width: 100%;
                height: 40vh;
            }
        }
        nav .navbar-nav .nav-item .nav-link{
            color: #1c91d0;
        }


    </style>
</head>

<!--=================================================================================================================-->

<body>
<!--===============================================HEADER============================================================-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#" style="flex:1">
        <img src="img/icon.jpg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        What's the weather?
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <?php
                    if(isset($_SESSION["userid"])){
                        echo "<a class='nav-link'>Witaj, $name </a>";
                    }
                    ?>
            </li>
        <?php
       if(isset($_SESSION["userid"])){
            if($role=="admin"){
                echo "<li class='nav-item'><a class='nav-link' href='userManaging.php'>Zarządzanie użytkownikami</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='advertPanel.php'>Zarządzanie reklamami</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='addAdvertisement.php'>Dodaj reklamę</a></li>";
            }
            echo "<li class='nav-item'><a class='nav-link' href='userPanel-data.php'>Panel użytkownika</a></li>";
            echo "<li class='nav-item'><a href='logout.php' class='btn btn-outline-danger'>Wyloguj się</a></li>";
        }
        else{
            echo "<li class='nav-item'><a class='nav-link' href='login.php'>Zaloguj</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='registration2.php'>Zarejestruj się</a></li>";
        }
        ?>
        </ul>
    </div>
</nav>
<!--===============================================MAIN==============================================================-->
<div class="container-fluid">
    <div class="advertisement"></div>
    <div class="row no-gutters">
        <div class="col-md-12 row no-gutters">
            <!-----------------WEATHER CARD------------------>
            <div class="col-md-4 text-center search-city">
                <div class="mt-2">
                    <input id="city" type="text" name="" autocomplete="off" class="search-box"
                           placeholder="Wyszukaj miasto...">
                </div>

                <div class="mt-5">
                    <section class="location">
                        <div id="city-country" class="city mt-2"></div>
                        <div class="date mt-2"></div>
                    </section>

                    <div class="image weather-image mt-3">
                    </div>

                    <div class="current mt-5">
                        <div class="temp mt-2"><span></span></div>
                        <div class="weather mt-1"></div>
                        <div class="hi-low mt-2"></div>
                    </div>
                </div>
            </div>

            <!---------------------MAP----------------------->

            <div class="col-md-6">
                <div id="mapid">
                </div>
            </div>

            <!-----------------CITIES CARD------------------->
            <div class="col-md-2">
                <h4 class="h4TwojeMiasta">Twoje Miasta</h4>
                <ul class="list-group list-group-flush" id="cities">
                </ul>
            </div>
        </div>

        <!-----------------AD------------------>

    </div>
    <div class="advertisement"></div>
    <div class="row">
        <div id="chartContainer" style="width=100%; height=80vh;">
           <!-- <canvas id="myChart"></canvas>-->
        </div>
    </div>
</div>

<!--===============================================FOOTER============================================================-->
<br>
<br>
<footer>
    <p>&copy; Danylo Arbuzov, Jerzy Grzelak, Weronika Marszał</p>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script src="src/map.js"></script>
<script src="src/advertisement.js"></script>
<script src="js/server.js"></script>
<script src="js/pogoda.js"></script>
<script src="src/advertLike.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</body>
<template id="advertisementTemplate">
    <div class="tile">
        <img class="advert-image">
        <div class="details">
            <button class="like">
                <i class="icon fa"> </i>
                        </button>
            <span class="title"></span>
            <span class="desc info"></span>
        </div>
    </div>

</template>
</html>