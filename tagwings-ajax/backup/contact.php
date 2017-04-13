

<?php 

require_once('db.php');

$s = new Service();


$flag = "";
$nameErr    = "";
$emailErr   = "";
$contactErr = "";
$resumeErr  =   "";
$name       =   "";
$email      =   "";
$contact    =   "";
$success    =   "";
$message    =   "";

    $erroroccured = 0;
    $display_error = "display-hide";
    $display_success = "display-hide";
    $error = "Please fill the mandatory fields below and submit again.";
    $success = "Processing...";

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    $name   =   test_input($_POST['name']);
    $email  =   test_input($_POST['email']);
    $contact=   test_input($_POST['contact']);
    $message=   test_input($_POST['message']);
    
     if($name == "" || $email == "" || $contact == "" || $message == "" )
        {
            $erroroccured = 1;
            $error = "Please fill the mandatory fields.";
        }
   
    if(!preg_match("/^[a-zA-Z ]*$/",$name))
    {
        $nameErr    =   "Only letter and white space allowed.";
        $erroroccured   =   1;
                
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $erroroccured == 0)
    {
        $emailErr   =   "Invalid email format.";
        $erroroccured   =   1;
                
    }
    
    if(!(preg_match('/^\d{12}$/',$contact) || preg_match('/^\d{11}$/',$contact) || preg_match('/^\d{10}$/',$contact) ) && $erroroccured == 0)
    {
        $contactErr =   "Invalid contact detail.";
        $erroroccured   =   1;
    }
    
   if($erroroccured == 0)
    {
    
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
         if($flag > 0)
            {
                //echo $full_name, $email,$mobile, $user_type, $pass, $cpass;
               // echo '<script>alert("Thank You For Application");</script>';
                //echo '<script>window.location.assign("index.php");</script>';
                $display_error = "display-hide";
                $display_success = "";
                $success = " You have applied successfully.";
                echo'<script> setTimeout(function(){
                         window.location.assign("index.php"); 
                    }, 80000);</script>';
                $name = "";
                $email = "";
                $contact = "";
                $message = "";
                
            }
            else{
                $display_error = "";
                $display_success = "display-hide";
                $error = "Something went wrong with database. Please try again later.";
                /*echo '<script>alert("Error in Submiting");</script>';*/
                echo '<script> setTimeout(function(){  location.reload(); }, 20000);</script>';
            }
       }
    
    if($erroroccured == 0)
    {
       /* mail to admin*/
        $to = 'arun.tagwings@gmail.com';
        $subject = "Tagwings  Notification";

        $message = 'Applied for job.';

        $headers .= 'From: arun.tagwings@gmail.com';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        if(!mail($to,$subject,$message,$headers))
        {
                    //$erroroccured = 1;
            $error = "Something went wrong while sending email..";
        } 
        
    
    
    }
    
    
    else
    {
        $display_error = "";
        $display_success= "display-hide";
    }
    
}

function test_input($data){
    $data   =   trim($data);
    $data   =   stripslashes($data);
    $dtaa   =   htmlspecialchars($data);
    return $data;
}

 ?>