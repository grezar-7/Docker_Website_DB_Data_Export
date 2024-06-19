<?php echo file_get_contents("html/header.html"); ?>
<?php echo file_get_contents("html/test.html"); ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if (isset($_POST['sendMessage'])) {  //When the button is pressed
$mail = new PHPMailer(true);
$emailMessage = $_POST['emailMessage'];

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'testEmail@gmail.com';                 // SMTP username
    $mail->Password   = 'nice try';                  // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('your-email@gmail.com', 'Your Name');
    $mail->addAddress('recipient-email@example.com', 'Recipient Name'); // Add a recipient

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'Test of Grezars SMTP Using PHPMailer';
    $mail->Body    = emailMessage;
    $mail->AltBody = emailMessage;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}}



?>
<?php echo file_get_contents("html/footer.html"); ?>