<?php
define('DB_SERVER', '#');
define('DB_USERNAME', '#');
define('DB_PASSWORD', '#');
define('DB_NAME', '#');

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
