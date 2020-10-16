<?php
//Database connection
header("Content-Type:application/json");
if((isset($_GET['emailid']) && $_GET['emailid']!="") && (isset($_GET['password']) && $_GET['password']!="")) 
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
       $checkAvailablity = "SELECT *FROM `panel_mstr` WHERE `email_id` = '$lsemailid' AND `password` = '$lspassword'";
       $resultCheckQuery = mysqli_query($connection,$checkAvailablity);
       if(mysqli_num_rows($resultCheckQuery) == 1)
       {
        $response = [
               "responseMSG" => "Successfully Login !"
        ];
        response($response);
       }else{
              $response = [
                    "responseMSG" => "Please You Create Account !"
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