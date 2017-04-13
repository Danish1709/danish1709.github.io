 <?php              require_once('../includes/initialize.php');
                    $s = new Service();
                    /*$target_dir = RESUME_PATH_BASE_URL;
                    echo $_SERVER["DOCUMENT_ROOT"].$target_dir;
                    exit;*/
                    $subject = "Enquiry from Tagwings  Website";
                
                    $jsonarray = array();
                    $response_code = 0;
                    $response_msg = "";
                    $erroroccured = 0;
                    $name  = $_POST['name'];
                    $email = $_POST['email'];
                    $mobile = $_POST['mobile'];
                        
                        if($name == "" || $email == "" || $mobile == "")
                        {
                            $response_code = 1;
                            $response_msg = "Please fill the mandatory fields below and submit again.";
                          
                        }
                        
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL) && $response_code == 0)
                        {
                            $response_code = 1;
                            $response_msg = "Please fill the valid Email Address and submit again..";
                            
                            
                        }

                        if(!preg_match('/^\d{10}$/',$mobile) && $response_code == 0)
                        {
                            $mobileErr =   "Found Invalid Mobile Detail.";
                            $response_code = 1;
                            $response_msg = "Went something wrong with mobile number, try to submit again.";
                            $jsonarray["mobile_err"] = $mobileErr;
                        }
                    
                         if($response_code == 0)
                            { 
                                if(count($_FILES)>0)
                                {   
                                    if($_FILES["resume"]["name"] != "")
                                    {
                                        $allowedexts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG", "docs", "pdf", "docx");
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
                                                $response_msg = "Invalid document. Please upload a valid document.";
                                                $erroroccured = 1;
                                                $response_msg = 1;
                                            }
                                            else
                                            {   
                                                $query    =   "select max(id) from careers ";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute();
                                                //$check = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $check = $stmt->fetch();
                                                $ID = $check[0];
                                                $ID++;
                                                
                                                $target_dir = RESUME_PATH_BASE_URL;
                                                $filename    =    $_FILES['resume']['name'];
                                                $fitname   = substr($filename, stripos($filename,'.')+1);
                                                $filename = $ID.'.'.$fitname;
                                                $resume_file_path = $_SERVER["DOCUMENT_ROOT"].$target_dir."/".$filename;
                                                //move file to temp image folder
                                                if(!move_uploaded_file($_FILES["resume"]["tmp_name"], $resume_file_path))
                                                {
                                                   $response_msg = "Something went wrong while moving document. Kindly try again later.";
                                                   $erroroccured = 1;
                                                    $response_code = 1;
                                                }
                                            } 
                                        }
                                        else{
                                            $response_msg = "Invalid document. Please upload a valid document.";
                                            $erroroccured = 1;
                                            $response_code = 1;
                                        }
                                    }
                                    else{
                                        //$error = "Please attached document.";

                                        //$erroroccured = 1;
                                        //echo '<script>var confirm = confirm("You have not attached document. \n Do you like to submit.");</script>';


                                    }

                                }
                            }
    
                        if($response_code == 0)
                        {                            
                            $query      =   "INSERT INTO `careers`( `applicant_name`, `applicant_email`, `applicant_mobile`, `document_path`) VALUES (:name,:email,:contact,:path)";
                            //$filename = "arun";
                            $stmt = $conn->prepare($query);

                            $stmt->bindParam(":name",   $name,PDO::PARAM_STR);
                            $stmt->bindParam(":email",  $email,PDO::PARAM_STR);
                            $stmt->bindParam(":contact",$mobile,PDO::PARAM_INT);
                            $stmt->bindParam(":path" ,  $filename, PDO::PARAM_STR);
                            $stmt->execute();
                           
                            if($stmt->rowCount())
                            {
                                
                            }
                            else
                            {
                                $response_code = 1;
                                $response_msg = "Something went wrong with database";  
                            }
                        }

                       
                        if( $response_code == 0) 
                        {
                            //mail script goes here 
                            
                            /*$path = 'document';
                            $filename = '5.docx';
                            $file = $path . "/" . $filename;*/

                            
                            /*$mailto = 'arun.tagwings@gmail.com';
                            $subject = 'Arun is Testing for attchement';
                            $message = 'If done than good';

                            $content = file_get_contents($filename);
                            $content = chunk_split(base64_encode($content));

                            // a random hash will be necessary to send mixed content
                            $separator = md5(time());

                            // carriage return type (RFC)
                            $eol = "\r\n";

                            // main header (multipart mandatory)
                            $headers = "From: sent by Arun <arunjaisp@gmail.com>" . $eol;
                            $headers .= "MIME-Version: 1.0" . $eol;
                            $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
                            $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
                            $headers .= "This is a MIME encoded message." . $eol;

                            // message
                            $body = "--" . $separator . $eol;
                            $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
                            $body .= "Content-Transfer-Encoding: 8bit" . $eol;
                            $body .= $message . $eol;

                            // attachment
                            $body .= "--" . $separator . $eol;
                            $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
                            $body .= "Content-Transfer-Encoding: base64" . $eol;
                            $body .= "Content-Disposition: attachment" . $eol;
                            $body .= $content . $eol;
                            $body .= "--" . $separator . "--";

                            //SEND Mail
                            if (mail($mailto, $subject, $body, $headers)) {
                                echo "mail send ... OK"; // or use booleans here
                            } else {
                                echo "mail send ... ERROR!";
                                print_r( error_get_last() );
                            }*/
                            
                            
                            
                            
                            
                            
                            $response_code = 0;
                            $response_msg = "Thank You for your message. We will get back to you shortly.";
                            $name  = "";
                            $email = "";
                            $mobile= "";
                            
                        }

                        $jsonarray["name"] =$name;
                        $jsonarray["email"] =$email;
                        $jsonarray["mobile"] =$mobile;
                        $jsonarray["code"] = $response_code;
                        $jsonarray["response_message"] = $response_msg;
                        echo json_encode($jsonarray);
                        exit;
                       




?>