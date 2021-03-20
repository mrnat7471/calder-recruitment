<?php
require_once "config.php";

// Checks if account email is verified before accessing different pages.
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $stmt = $link->prepare('SELECT verified FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($verified);
    $stmt->fetch();
    $stmt->close();
}