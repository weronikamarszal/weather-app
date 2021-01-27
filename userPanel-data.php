<!DOCTYPE html>
<?php
require_once __DIR__ . '/PDO_databaseConnection.php';
global $dbh;

session_save_path(getcwd() . "/tmp");
session_start();
if(isset($_SESSION["userid"])){
    $name=$_SESSION["firstname"];
    $username=$_SESSION["username"];
    $email=$_SESSION["email"];
    $role=$_SESSION["role"];
    $userId=$_SESSION["userid"];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>What's the weather?</title>
    <link rel="shortcut icon" type="image/jpg" href="img/icon.jpg"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>User panel</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="main.css">
    <script src="js/utils.js"></script>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="index.php" style="flex:1">

        <img src="img/icon.jpg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        What's the weather?
    </a>
    <div class="navbar-actions">
        <?php
            if($role=="admin"){
                echo "<a href='userManaging.php'>Zarządzanie użytkownikami</a>";
                echo "<a href='advertPanel.php'>Zarządzanie reklamami</a>";
                echo "<a href='addAdvertisement.php'>Dodaj reklamę</a>";
            }

        ?>
        <a href="index.php">Strona główna</a>
        <a href='logout.php' class='btn btn-outline-danger'>Wyloguj się</a>
    </div>

</nav>


<div class="row">
    <div class="col-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Twoje miasta</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Twoje reklamy</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Twoje dane</a>
        </div>
    </div>
    <div class="col-10">
        <div class="tab-content" id="v-pills-tabContent">

            <!-- MOJE MIASTA -->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <?php
                    echo "<p style='text-align: center; font-size: xx-large'>Witaj, $name </p>";
                ?>

                <div class="addCity mt-5 pr-1">
                    <h4 class="h4addCity">Dodaj miasto do ulubionych</h4>
                    <div class="input-group mb-3">
                        <input type="text" id="addCityInput" class="form-control" placeholder="Wpisz miasto" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="button-addon2" onclick="setQuery()">Add</button>
                        </div>
                    </div>
                </div>

                <h4 class="h4TwojeMiasta mt-5">Twoje Miasta</h4>
                <div class="citiesList">
                    <ul class="list-group list-group-flush" id="citiesList">
                    </ul>
                </div>
            </div>

            <!-- MOJE REKLAMY -->
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <p style='text-align: center; font-size: xx-large'>Witaj, <?=$name?> </p>
            <?php
            $stmt= $dbh->prepare("SELECT * FROM advertisements a JOIN likes l on l.advertisementId = a.id WHERE userId = :userId ");
            $stmt->execute(array('userId' => $userId));
            $userAdverts = $stmt->fetchAll();
            ?>
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Tytuł </th>
                        <th>Opis</th>
                        <th>Więcej</th>
                        <th>Obrazek</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($userAdverts as $advertisement): ?>
                        <tr>
                            <td> <?= $advertisement['name'] ?> </td>
                            <td> <?= $advertisement['description'] ?> </td>
                            <td> <?= $advertisement['more'] ?> </td>
                            <td> <?= $advertisement['picture'] ?> </td>
                            <td> <?= $advertisement['link'] ?> </td>
                        </tr>
                    <?php endforeach; ?>


                    </tbody>
                </table>


            </div>

            <!-- MOJE DANE -->
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <?php
                echo "<p style='text-align: center; font-size: xx-large'>Witaj, $name </p>";
                ?>
                <div class="usersData">
                    <div class="name"> <div>Nazwa użytkownika:</div>
                        <div class="dbInfo">
                            <?php
                            echo $username;
                            ?>
                        </div>
                    </div>
                    <div class="username mt-2"> <div>Imię:</div>
                        <div class="dbInfo">
                            <?php
                            echo $name;
                            ?>
                        </div>
                    </div>
                    <div class="email mt-2"> <div>E-mail:</div>
                        <div class="dbInfo">
                            <?php
                            echo $email;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="changePassword mt-5">
                    <p style='text-align: center; font-size: x-large'>Zmiana hasła </p>
                    <input type="password" id="inputPassword" class="form-control mt-3" aria-describedby="passwordHelpInline" placeholder="Wpisz nowe hasło">
                    <input type="password" id="inputPassword2" class="form-control mt-2" aria-describedby="passwordHelpInline" placeholder="Powtórz nowe hasło">
                    <p id="passError"></p>
                    <div class="submitPass">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="showPassword()">
                            <label class="form-check-label" for="exampleCheck1">Pokaż hasło</label>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="changePassword()">Zmień haslo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<footer>
    <p>&copy; Danylo Arbuzov, Jerzy Grzelak, Weronika Marszał</p>
</footer>

<script src="js/adPanel.js"></script>
<script src="js/changePassword.js"></script>
<script src="js/getCitiesList.js"></script>

<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>


</body>
</html>