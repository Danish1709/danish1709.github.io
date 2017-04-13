<?php
    require_once('includes/class.phpmailer.php');
                $to = "arun.tagwings@gmail.com";
                $email_subject =" Testing Mail ";

                $mailbody=" Testing Mail";
                /*$reply_address = CONTACTUS_REPLY_ADD;
                $reply_person_name = CONTACTUS_REPLY_NAME;
                $from_address = CONTACTUS_FROM_ADD;
                $from_name = CONTACTUS_FROM_NAME;*/
                $alt_body = "To view the message, please use an HTML compatible email viewer!";

                echo 
                $mail = new PHPMailer(); // defaults to using php "mail()"

                /*if(USE_SMTP_SERVER==1)
                {
                    $mail->IsSMTP(); // telling the class to use SMTP
                    // 1 = errors and messages
                    // 2 = messages only
                    $mail->SMTPDebug  = SMTP_DEBUGGING;                     // enables SMTP debug information (for testing)
                    $mail->SMTPAuth   = true;                  // enable SMTP authentication
                    $mail->Host       = SMTP_HOST; // sets the SMTP server
                    $mail->Port       = SMTP_HOST_PORT;                    // set the SMTP port for the GMAIL server
                    $mail->Username   = SMTP_HOST_USERNAME; // SMTP account username
                    $mail->Password   = SMTP_HOST_PASSWORD;        // SMTP account password                
                }                
                */
                //$mail->SetFrom($from_address, $from_name);
                //$mail->AddReplyTo($reply_address,$reply_person_name);

                $mail->AddAddress($to);

                $mail->Subject = $email_subject;
                $mail->AltBody = $alt_body; // optional, comment out and test
                $mail->MsgHTML($body);
                if(!$mail->Send())
                {
                    $error = "Something went wrong while sending mail.";
                    $erroroccured = 1;
                }
else
{
    echo "issue";
}
?>