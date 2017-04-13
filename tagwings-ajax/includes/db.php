<?php 

class Service 
   {
       
       function __construct()
       {
           $servername = "localhost";
           $username = "root";
           $password  = "";
           $dbname    = "tagwings";
           global $conn;
           try
           {
               $conn = new PDO("mysql:host=$servername;dbname=$dbname","$username","$password");
               //$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
               
           }
          
           catch(PDOException $e)
             {
                 //echo $e.getMessage();
                 die('Error: '.$e->getMessage().' Code: '.$e->getCode());
             }
       }
   }

?>