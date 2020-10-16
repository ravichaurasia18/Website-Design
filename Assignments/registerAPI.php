<?php
//Database connection
header("Content-Type:application/json");
if((isset($_GET['emailid']) && $_GET['emailid']!="") && (isset($_GET['password']) && $_GET['password']!="") && (isset($_GET['securityQA']) && $_GET['securityQA']!="") && (isset($_GET['securityA']) && $_GET['securityA']!="")) 
    {
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $dbName = 'assignments';
      $connection = mysqli_connect($host, $user, $pass , $dbName) or die($connection); 
       //first we check email id repeat or not 
       //if repeat than give error already exist
       //if not repeat than insert in table data
       $lsemailid = $_GET['emailid'];
       $lspassword = md5($_GET['password']);
       $lsselectedQA = $_GET['securityQA']; 
       $lsselectedA = md5($_GET['securityA']); 
       $checkAvailablity = "SELECT *FROM `panel_mstr` WHERE `email_id` = '$lsemailid'";
       $resultCheckQuery = mysqli_query($connection,$checkAvailablity);
       if(mysqli_num_rows($resultCheckQuery) == 0)
       {
          $registerQuery = "INSERT INTO `panel_mstr`(`email_id`, `password`, `securityQA`, `securityA`) VALUES ('$lsemailid','$lspassword','$lsselectedQA','$lsselectedA')";
          $registerResult = mysqli_query($connection,$registerQuery);
          $response = [ 
              "responseMSG" => "Please Check Mail & Verify !"
          ];
          response($response);
       }else{
              $response = [ 
                  "responseMSG" => "User Already Exist !"
              ];
              response($response);
       };
    };
    function response($response)
    {
        $json_response = json_encode($response);
        echo $json_response;
    };
?>