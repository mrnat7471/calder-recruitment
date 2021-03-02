<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); #user
define('DB_PASSWORD', ''); #vhR8t76#
define('DB_NAME', 'recruitment');

$servername = DB_SERVER;
$username = DB_USERNAME; #user
$password = DB_PASSWORD; #vhR8t76#
$dbname = DB_NAME;
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>