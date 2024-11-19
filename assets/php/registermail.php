<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

  // Load Composer's autoloader
          require 'vendor/autoload.php';
          $mail = new PHPMailer(true);
          // Sanitize inputs
    try {
               $mail->isSMTP();
               $mail->Host = 'smtp.gmail.com'; // Correct SMTP server
               $mail->SMTPAuth = true;
                
               // Use your own Gmail account credentials to authenticate
               $mail->Username = $_ENV['Username'];  // Your Gmail address
               $mail->Password =$_ENV['Password'];  // Your Gmail address
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption method
               $mail->Port = 587;  // TLS port is 587
           
               // Set the sender email (user's email address)
               $mail->setFrom( $_ENV['Username']);  // $email is user input
               $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];
            
               // Add the recipient email (admin or destination email)
               $mail->addAddress($email); 
               $mail->addReplyTo($_ENV['Username'], 'Add reply');
               // Set email format to HTML
               $mail->isHTML(true);
               $mail->Subject = "Registration link";
               // .date("l jS \of F Y h:i:s A").
               $mail->Body = "
               <div>
                   <h1>Hello User</h1><br><br>
                   <p>You have received a new registration link, please</p><br><br>
                   <a href='http://localhost/Soccer-Spotlight/assets/php/action.php?action=registerlink&email=$email'>click here</a><p>to register</p>  
               </div>";
               
               // $mail->SMTPDebug = 3; // Set to 0 in production to avoid exposing sensitive information
              
               // Send the email
              
             
               if($mail->send())
               {
                    $msg="success+".$db->msg('success', "Mail has been sent");
                    echo $msg;
               }
               else
               {
                   echo $db->msg('danger', "Something wrong sending email");
               }
             }  
            catch (Exception $e) {
               // Output detailed error message
               echo 'Mailer Error: ' . $mail->ErrorInfo;
           }
    