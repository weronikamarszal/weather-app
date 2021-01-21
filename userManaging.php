<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="userManaging.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

<div class="container">
    <div class="row no-gutters">
        <div class="col-md-1"></div>
        <div class="col-md-10 text-center">
            <div class="mt-5">
                <h3>Users Managing</h3>
            </div>

            <div class="input-group mb-3 mt-3">
                <input type="text" id="search-text" onkeyup="tableSearch()" class="form-control" placeholder="Find user by id/username/name/e-mail" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>

<?php
require_once 'databaseConnection.php';

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query) or die( mysqli_error($conn) );

    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    ?>

            <div class="mt-5" style="overflow: auto; height:50%">
                <table id="table" class="table table-hover table-sm">
                    <thead>
                    <tr class="table-row">
                        <th data-field="id" scope="col">id</th>
                        <th data-field="username" scope="col">username</th>
                        <th data-field="name" scope="col">name</th>
                        <th data-field="e-mail" scope="col">e-mail</th>
                        <th data-field="block" scope="col">blocking</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $dbUsername) { ?>
                        <tr class="table-row"">
                            <td><?= $dbUsername['userId'] ?></td>
                            <td><?= $dbUsername['userName'] ?></td>
                            <td><?= $dbUsername['userFirstName'] ?></td>
                            <td><?= $dbUsername['userEmail'] ?></td>
                            <td><a href='/weather-app/deletelist.php?id=<?= $dbUsername['userId'] ?>'>Block user</a></td>
                        </tr>
                    <?php }?>
                    </tbody>
                    </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<script src="js/userManaging.js"></script>
</body>
