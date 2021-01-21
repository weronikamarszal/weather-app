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
            <div class="row no-gutters">
                <div class="col-12 login">
                    <form method="post">
                    <h4>Ostatni krok!</h4>
                    <div class="mt-2">
                        <div>
                            Już prawie koniec! Zaakceptuj regulamin, aby zakończyć proces rejestracji!
                            <br>
                            <br>
                            <input class="accept" id="acceptRegulation" type="checkbox" autocomplete="off">
                            <label>Akceptuję regulamin</label>
                        </div>
                        <button type="submit" name="submit2" class="login-field btn-primary" id="next" onclick="onNextClick(event)">Dalej</button>

                    </div>
                </div>
            </div>
            <div class="row no-gutters additional-actions">
                <a href="login.php" id="regulation">Przeczytaj regulamin</a>
            </div>
        </div>
        </form>
        <div class="col-md-3"></div>
    </div>
</div>
<?php

function sanitizeEmail($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
$email=$_COOKIE['email'];
$vkey=$_COOKIE['vkey'];/*
                        $to =$email;
                        $subject = "What's the weather? - weryfikacja adresu e-mail.";
                        $message ="<html><body> <a href='http://localhost:63342/test2/verify.php?vkey=$vkey'> Potwierdź swój adres email.
                          </a></body></html>";
                        $headers="From: greenbanzai@gmail.com\r\n";
                        $headers.="Content-type: text/html\r\n";
                        $mail=mail($to,$subject,$message,$headers);
                        */
if (isset($_POST["submit2"])){

    header("location: registrationStep3.html");
    exit();
}
?>

</body>
</html>

<script>
function onNextClick (event) {
   if(!document.getElementById("acceptRegulation").checked) {
       alert("Zaakceptuj regulamin!");
       event.preventDefault();
   }
}
</script>