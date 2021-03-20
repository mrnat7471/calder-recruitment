<?php include '../layout/navbar.php';
$userid = $_SESSION['id'];
// Grabs accounts firstName.
$stmt = $link->prepare('SELECT firstName FROM users WHERE uuid = ?');
$stmt->bind_param('i', $userid);
$stmt->execute();
$stmt->bind_result($firstName);
$stmt->fetch();
$stmt->close();

if(isset($_GET['id'])){
    // Grabs selected message details.
    $id = $_GET['id'];
    $stmt = $link->prepare('SELECT * FROM messages WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($uuid, $receiver, $sender, $subject, $content, $timestamp);
    $stmt->fetch();
    $stmt->close();

    // Grabs staff member's details.
    $stmt = $link->prepare('SELECT firstName, lastName FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $sender);
    $stmt->execute();
    $stmt->bind_result($staff_firstName, $staff_lastName);
    $stmt->fetch();
    $stmt->close();
}
?>
<div class="content">
    <h5><b>Calderdale College - <?=$subject?></b></h5>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <!-- LOGO -->
            <tr>
                <td bgcolor="#2f998a" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#2f998a" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                <img src="https://nathan7471.xyz/img/lAco9/zukuzOjE67.png/raw" width=250px>
                                <h5 style="margin-top:10px;font-size: 28px; font-weight: 400; margin: 2;"></h5> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Hello <?=$firstName?>,</p><br>
                                <p style="margin: 0;"><?=$content?></p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Cheers,<br><?=$staff_firstName?> <?=$staff_lastName?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                                <p style="margin: 0;">If you got this email by mistake, please ignore and delete this email.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
</div>
<?php include '../layout/footer.php';?>
<style>
.content{
    margin-left:250px;
    margin-right:250px;
    margin-top:30px;
}
@media(max-width:500px){
    .content{
        margin-left:15px!important;
        margin-right:15px;
        margin-top:10px;
    }
}
</style> 