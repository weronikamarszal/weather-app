<?php
$serverName="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="baza";

$conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
if(!conn){
    die("Połączenie nie udało się: " . mysqli_connect_error());
}