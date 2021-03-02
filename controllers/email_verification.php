<?php
require_once "config.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $stmt = $link->prepare('SELECT verified FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($verified);
    $stmt->fetch();
    $stmt->close();

    if($verified === 0){
        header("Location: ./verify");
    }
}