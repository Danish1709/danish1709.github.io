<?php 

require_once('db.php');
$s = new Service();

$nameErr    = "";
$emailErr   = "";
$contactErr = "";
$erroroccured = 0;

$flag = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
      $filename    =    $_FILES['resume']['name'];
    $filetype    =    $_FILES['resume']['type'];
    $filesize    =    $_FILES['resume']['size'];
    $tmpname     =    $_FILES['resume']['tmp_name'];
    
    //echo $erroroccured.$name;
        

    $fitname   = substr($filename, stripos($filename,'.')+1);
    //$filename  = 'arun';
    //$path = "document/resume/".$ID.'.'.$fitname;
    //$prop_img         = $_POST['prop_img'];
    /*echo $filesize;
    
    exit;*/
    
    if($_FILES['resume']['size'] < 2097152)/*3003681*/
    {
        $size = 'valid file';
    if($_FILES['resume']['error'] > 0)
    {
        $err = 'file is exceed';

    }
    else{
        $err = 'ok';
    }
    echo $err;
    exit; 
    }
    else{
        $size ='long file detected ';
        //echo 'long file detected '.$filesize;
       // exit;
    }
    echo $size. $filesize;
    exit;
    
    $query    =   "select max(id) from careers ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    //$check = $stmt->fetch(PDO::FETCH_ASSOC);
    $check = $stmt->fetch();
    $ID = $check[0];
    $ID++;
    //echo $ID;
    $name   =   $_POST['name'];
    $email  =   test_input($_POST['email']);
    $contact=   test_input($_POST['contact']);
    
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
    
    if(!preg_match('/^\d{10}$/',$contact)) // phone number is valid
    {
        $contactErr =   "Invalid contact detail.";
        $erroroccured   =   1;
        
    }
    
  
    move_uploaded_file($tmpname, $path);

    if($erroroccured == 0)
    {
    
        $query      =   "INSERT INTO `careers`( `applicant_name`, `applicant_email`, `applicant_mobile`, `document_path`) VALUES (:name,:email,:contact,:path)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name",   $name,PDO::PARAM_STR);
        $stmt->bindParam(":email",  $email,PDO::PARAM_STR);
        $stmt->bindParam(":contact",$contact,PDO::PARAM_INT);
        $stmt->bindParam(":path" ,  $path, PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->rowCount())
        {
          $flag++;  
        }
    }
    
     if($flag > 0)
            {
                //echo $full_name, $email,$mobile, $user_type, $pass, $cpass;
                echo '<script>alert("Thank You For Application");</script>';
                echo '<script>window.location.assign("index.php");</script>';
            }
            else{
                echo '<script>alert("Error in Submiting");</script>';
                echo '<script>window.location.assign("careers.php");</script>';
            }
           
    
}

function test_input($data){
    $data   =   trim($data);
    $data   =   stripslashes($data);
    $dtaa   =   htmlspecialchars($data);
    return $data;
}


?>