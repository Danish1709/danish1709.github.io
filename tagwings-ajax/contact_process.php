<?php

require_once('db.php');

$s = new Service();

$flag   =   "";
$erroroccured   =   0;
$nameErr    =   "";
$emailErr   =   "";
$contactErr =   "";



if($_SERVER['REQUEST_METHOD'] == "POST")
    
{
    $name   =   test_input($_POST['name']);
    $email  =   test_input($_POST['email']);
    $contact=   test_input($_POST['contact']);
    $message=   $_POST['message'];
    
    
    if(!preg_match("/^[a-zA-Z]*$/",$name))
    {
        $nameErr    =   "Only letter and white space allowed.";
        $erroroccured   =   1;
         
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $emailErr   =   "Invalid email formate.";
        $erroroccured   =   1;
        
    }
    
  /*  if(!preg_match('/^\d{15}$/',$contact)) 
    {
        $contactErr =   "Invalid contact detail.";
        $erroroccured   =   1;
        
    }*/
    
    if( $erroroccured == 0){
       
      $sql    =   "INSERT INTO `contact`( `applicant_name`, `applicant_email`, `applicant_mobile`, `applicant_message`) VALUES (:name, :email, :mobile, :message)";
    
        $stmt   =   $conn->prepare($sql);
    
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindPARAM(":mobile", $contact, PDO::PARAM_INT);
        $stmt->bindPARAM(":message", $message, PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->rowCount())
        {
           $flag++; 
        }
        
    }
    else{
        //echo $nameErr.$emailErr.$contactErr;
    }
    
    /*mail to admin*/
    /* $to='arunjaisp@gmail.com';
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
    
    
    
    mailed to applicant
    
    $msg    =   "Tagwings get touch with you soon.."

        
        $subject = "TagWings Technologies Pvt Ltd";
$user_email = "arunjaisp@gmail.com";

        
$headers = "From: arunjaisp@gmail.com" . "\r\n ";
       
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				mail($user_email,$subject,$msg,$headers);
                echo '<script> 
                    alert("Sent Successfully");
                            
					</script> ';*/
    
     if($flag > 0)
            {
                //echo $full_name, $email,$mobile, $user_type, $pass, $cpass;
                echo '<script>alert("Thank You For Application");</script>';
                echo '<script>window.location.assign("index.php");</script>';
            }
            else{
                echo '<script>alert("Error in Submiting");</script>';
                echo '<script>window.location.assign("contact.php");</script>';
            }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>