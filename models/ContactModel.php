<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$result="";
if(isset($_POST['submit'])){
    // Load Composer's autoloader
    #require 'vendor/autoload.php';
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = "smtp.gmail.com";                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = "bookshareonline@gmail.com";                                     // SMTP username
        $mail->Password   = "bureksasirom";                                     // SMTP password
        $mail->SMTPSecure = "tls";//PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
        
        //Recipients;
        $mail->setFrom($_POST['email'], 'Contact Message');
        $mail->addAddress("bookshareonline@gmail.com");     // Add a recipient
        $mail->addReplyTo($_POST['email']);
        
        $mail->Subject = 'Message';
        // Attachments
        //$mail->addAttachment('C:\Users\Petar\Desktop\bs.jpeg');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
        #$body = '<p>From: '.$_POST['firstname'].' '.$_POST['lastname'].':'.' '.$_POST['message'].'</p>';
        $body = '<p>From: '.$_POST['name'].' '.$_POST['message'].'</p>';      
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);
        
        $mail->send();
        $result = 'Thanks Mr/Ms '.$_POST['name'].' '.' for contacting us. We will get back to you soon!';        
    } catch (Exception $e) {
        $result = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
    
    try {
        
        $user = new User();
        $user->contact(array(
            'first_name'=>Input::get('name'),
            #'last_name'=>Input::get('lastname'),
            'email'=>Input::get('email'),
            'message'=>Input::get('message')
        ));
        
    } catch (Exception $e) {
        die();
    }  
    
}
?>