<?php
define('DB_SERVER', 'localhost:3306'); #localhost:3306
define('DB_USERNAME', 'calder'); #calder
define('DB_PASSWORD', '9#Ulmr21'); #9#Ulmr21
define('DB_NAME', 'recruitment');

$servername = DB_SERVER;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>