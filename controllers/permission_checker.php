<?php
// Checks the login users role and have what permissions they have.
require_once "config.php";
$uuid = 0;
$roleID = 0;
$ADMIN_READ = 0;
$APPLICANT_READ = 0;
$ROLE_MANAGE = 0;
$ROLE_MANAGE_2 = 0;
$USER_ROLE_MANAGE = 0;
$PROGRESS = 0;

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    $stmt = $link->prepare('SELECT user_role, progress FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($userRole, $PROGRESS);
    $stmt->fetch();
    $stmt->close();

    $stmt = $link->prepare('SELECT * FROM roles_permissions WHERE role_id = ?');
    $stmt->bind_param('i', $userRole);
    $stmt->execute();
    $stmt->bind_result($uuid, $roleID, $ADMIN_READ, $APPLICANT_READ, $ROLE_MANAGE, $USER_ROLE_MANAGE);
    $stmt->fetch();
    $stmt->close();

    $ROLE_MANAGE_2 = $ROLE_MANAGE;
}
?>