
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
                    $message = $_POST['message'];
                        
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

                        /*if(!preg_match('/^\d{10}$/',$mobile) && $response_code == 0)
                        {*/
                        if(!(preg_match('/^\d{12}$/',$mobile) || preg_match('/^\d{11}$/',$mobile) || preg_match('/^\d{10}$/',$mobile) ) && $response_code == 0)
                        {
                            $mobileErr =   "Found Invalid Mobile Detail.";
                            $response_code = 1;
                            $response_msg = "Went something wrong with mobile number, try to submit again.";
                            $jsonarray["mobile_err"] = $mobileErr;
                        }

                         if($response_code == 0)
                        {

                            $sql    =   "INSERT INTO `contact`( `applicant_name`, `applicant_email`, `applicant_mobile`, `applicant_message`) VALUES (:name, :email, :mobile, :message)";

                            $stmt   =   $conn->prepare($sql);

                            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                            $stmt->bindPARAM(":mobile", $mobile, PDO::PARAM_INT);
                            $stmt->bindPARAM(":message", $message, PDO::PARAM_STR);
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
                             /* mail to admin*/
                                /*$to = 'arun.tagwings@gmail.com';
                                $subject = "Tagwings  Notification";

                                $message = 'Applied for job.';

                                $headers .= 'From: arun.tagwings@gmail.com';

                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                                if(!mail($to,$subject,$message,$headers))
                                {
                                            //$erroroccured = 1;
                                    $error = "Something went wrong while sending email..";
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