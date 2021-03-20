<?php include '../layout/navbar.php';

if(isset($_POST['subject'])){
    // Grabs receiver's firstName, lastName, email.
    $receiver = $_POST['receiver'];
    $stmt = $link->prepare('SELECT firstName, lastName, email FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $receiver);
    $stmt->execute();
    $stmt->bind_result($user_firstName, $user_lastName, $user_email);
    $stmt->fetch();
    $stmt->close(); 
    $sender = $_SESSION['id'];

    // Grabs staff's firstName, lastName
    $stmt = $link->prepare('SELECT firstName, lastName FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $sender);
    $stmt->execute();
    $stmt->bind_result($staff_firstName, $staff_lastName);
    $stmt->fetch();
    $stmt->close(); 
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    //Sends email to the selected user.
    require_once '../vendor/autoload.php';

    $transport = (new Swift_SmtpTransport('fw-cpanel01.fyfeweb.com', 465, 'ssl'))
    ->setUsername('website@reachradio.co.uk')
    ->setPassword('[&Rb_y8&x?oP');

    $mailer = new Swift_Mailer($transport);

        global $mailer;
        $body = '<!DOCTYPE html>
        <html>
        
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <style type="text/css">
                @media screen {
                    @font-face {
                        font-family: "Lato";
                        font-style: normal;
                        font-weight: 400;
                        src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff");
                    }
        
                    @font-face {
                        font-family: "Lato";
                        font-style: normal;
                        font-weight: 700;
                        src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff");
                    }
        
                    @font-face {
                        font-family: "Lato";
                        font-style: italic;
                        font-weight: 400;
                        src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");
                    }
        
                    @font-face {
                        font-family: "Lato";
                        font-style: italic;
                        font-weight: 700;
                        src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff");
                    }
                }
        
                /* CLIENT-SPECIFIC STYLES */
                body,
                table,
                td,
                a {
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }
        
                table,
                td {
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }
        
                img {
                    -ms-interpolation-mode: bicubic;
                }
        
                /* RESET STYLES */
                img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                }
        
                table {
                    border-collapse: collapse !important;
                }
        
                body {
                    height: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    width: 100% !important;
                }
        
                /* iOS BLUE LINKS */
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                }
        
                /* MOBILE STYLES */
                @media screen and (max-width:600px) {
                    h1 {
                        font-size: 32px !important;
                        line-height: 32px !important;
                    }
                }
        
                /* ANDROID CENTER FIX */
                div[style*="margin: 16px 0;"] {
                    margin: 0 !important;
                }
            </style>
        </head>
        
        <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
            <!-- HIDDEN PREHEADER TEXT -->
            <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Lato, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We are thrilled to have you here! Get ready to dive into your new account. </div>
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
                                <p style="margin: 0;">Hello ' . $user_firstName . ',</p><br>
                                <p style="margin: 0;">' . $content . '</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Cheers,<br>' . $staff_firstName . ' ' . $staff_lastName . '</p>
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
        </body>
        
        </html>';

        // Create a message
        $message = (new Swift_Message('Calderdale College - ' . $subject))
            ->setFrom('website@reachradio.co.uk')
            ->setTo($user_email)
            ->setBody($body, 'text/html');

        // Send the message
        $emailresult = $mailer->send($message);

        // Add message to messages table for future access via message page.
        $sql = "INSERT INTO messages (receiver, sender, subject, content) VALUES ('$receiver', '$sender', '$subject', '$content')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Your message has been sent.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

$connection = $link;
$id = $_SESSION['id'];
$sql3 = "SELECT * FROM applications WHERE staff_id=$id";
$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
$emparray3 = array();
while($row3 =mysqli_fetch_assoc($result3))
{
    $emparray3[] = $row3;
}
$apidata3 = json_encode($emparray3);
$data3 = json_decode($apidata3);?>
<div class="content">
<?php if($APPLICANT_READ == 1){ ?>
    <h5><b>Messages</b></h5>
    <?php if(isset($success_message) || isset($danger_message)){ ?>
    <div class="m-2">
        <?php if(isset($success_message)){ ?>
        <div class="alert alert-success" role="alert">
            <?= $success_message; ?>
        </div>
        <?php } if(isset($danger_message)){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $danger_message; ?>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <form method="POST" action="#">
        <label>Receiver (Claimed Applications):</label>
        <select name="receiver" class="form-control">
                    <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <?php foreach($data3 as $apidata3){
                    $profile_id = $apidata3->profile_id;
                    $stmt = $link->prepare('SELECT firstName, lastName FROM users WHERE uuid = ?');
                    $stmt->bind_param('i', $profile_id);
                    $stmt->execute();
                    $stmt->bind_result($user_firstName, $user_lastName);
                    $stmt->fetch();
                    $stmt->close(); ?>
                    <option value="<?=$profile_id?>"><?=$user_firstName?> <?=$user_lastName?></option>
            <?php } ?>
        </select><br>
        <label>Subject:</label><br>
        <input type="text" name="subject" class="form-control" required><br>

        <label>Content:</label><br>
        <textarea id="editor" style="height:250px;width:100%" name="content" class="form-control" required></textarea><br>

        <button class="btn btn-primary my-2 my-sm-0" type="submit">Send</button><br><br>
    </form>
<?php }else{ ?>
  <h6>You don't have permission to go there. </h6>
<?php }  ?>  
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