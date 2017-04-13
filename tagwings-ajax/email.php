<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        //$subject=$_POST['subject'];
        $message=$_POST['message'];
        
        $to='arunjaisp@gmail.com';
        $Message="A New Message has been Sent by $email \n Their Messsage was $message \n \n Their Detail is:\n \n Name: $name \n Email:$email \n Phone No.:$contact ";
        
        if($name)
        {
          if($email)
          {
              if($message)
              {
                 mail($to,$subject,$Message); 
              }
              else
              {
                echo 'Please Enter Some Message';   
              }
          }
            else
            {
                echo 'Please Enter an Email address';
            }
        }
        else
        {
          echo 'Please Enter Your Name';  
        }
        
    }



/*================================*/

<?php
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Thank you for contact us. As early as possible  we will contact you '
	);

    $name = @trim(stripslashes($_POST['name'])); 
    $email = @trim(stripslashes($_POST['email'])); 
    $subject = @trim(stripslashes($_POST['subject'])); 
    $message = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'firsttake005@gmail.com';//replace with your email

    $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

    $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

    echo json_encode($status);
    die;
?>