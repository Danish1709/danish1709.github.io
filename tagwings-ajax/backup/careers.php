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

$file_size = "";

    $erroroccured = 0;
    $display_error = "display-hide";
    $display_success = "display-hide";
    $error = "Please fill the mandatory fields below and submit again.";
    $success = "Processing...";

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    $query    =   "select max(id) from careers ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    //$check = $stmt->fetch(PDO::FETCH_ASSOC);
    $check = $stmt->fetch();
    $ID = $check[0];
    $ID++;
    //echo $ID;
    $name   =   test_input($_POST['name']);
    $email  =   test_input($_POST['email']);
    $contact=   test_input($_POST['contact']);
    
     if($name == "" || $email == "" || $contact == "" )
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
            if(count($_FILES)>0)
            {             
                
                if($_FILES["resume"]["name"] != "")
                {
                    $allowedexts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG", "docs", "pdf", "");
                    $temp = explode(".", $_FILES["resume"]["name"]);
                    $extension = end($temp);

                    if ((($_FILES["resume"]["type"] == "image/jpeg")
                    || ($_FILES["resume"]["type"] == "image/jpg")
                    || ($_FILES["resume"]["type"] == "image/png")
                    || ($_FILES["resume"]["type"] == "image/JPEG")
                    || ($_FILES["resume"]["type"] == "image/PNG")
                    || ($_FILES["resume"]["type"] == "image/JPG")
                    || ($_FILES["resume"]["type"] == "image/docs")
                    || ($_FILES["resume"]["type"] == "image/pdf")
                    || ($_FILES["resume"]["type"] == "image/docx"))
                    && ($_FILES["resume"]["size"] < 2000000)
                    && in_array($extension, $allowedexts))
                    {
                        if ($_FILES["resume"]["error"] > 0)
                        {
                            $error = "Invalid document. Please upload a valid document.";
                            $erroroccured = 1;
                        }
                        else
                        {   
                            //give a unique name to the file
                            /*$img_file_type = pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION);
                            $target_dir = resume_PATH_BASE_URL;  
                            $filename = sha1(rand().microtime()).".".$img_file_type; 
                            
                            $image_file_path = $_SERVER["DOCUMENT_ROOT"]."/".$target_dir."/".$filename;*/
                            $filename    =    $_FILES['resume']['name'];
                            $fitname   = substr($filename, stripos($filename,'.')+1);
                            $document_file_path = "document/resume/".$ID.'.'.$fitname;
                            //move file to temp image folder
                            if(!move_uploaded_file($_FILES["resume"]["tmp_name"], $document_file_path))
                            {
                               $error = "Something went wrong while moving document. Kindly try again later.";
                               $erroroccured = 1;
                            }
                        } 
                    }
                    else{
                        $error = "Invalid document. Please upload a valid document.";
                        $erroroccured = 1;
                    }
                }
                else{
                    //$error = "Please attached document.";
                    
                    //$erroroccured = 1;
                    //echo '<script>var confirm = confirm("You have not attached document. \n Do you like to submit.");</script>';
                    
                    
                }
                
            }
        }
    
    

 
    if($erroroccured == 0)
    {
    
        $query      =   "INSERT INTO `careers`( `applicant_name`, `applicant_email`, `applicant_mobile`, `document_path`) VALUES (:name,:email,:contact,:path)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name",   $name,PDO::PARAM_STR);
        $stmt->bindParam(":email",  $email,PDO::PARAM_STR);
        $stmt->bindParam(":contact",$contact,PDO::PARAM_INT);
        $stmt->bindParam(":path" ,  $document_file_path, PDO::PARAM_STR);
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
                    }, 8000);</script>';
                $name = "";
                $email = "";
                $contact = "";
                
            }
            else{
                $display_error = "";
                $display_success = "display-hide";
                $error = "Something went wrong with database. Please try again later.";
                /*echo '<script>alert("Error in Submiting");</script>';*/
                echo '<script> setTimeout(function(){  location.reload(); }, 20000);</script>';
            }
       } 
    else{
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
