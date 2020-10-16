<?php
//Database connection
header("Content-Type:application/json");
if((isset($_GET['emailid']) && $_GET['emailid']!="")) 
    {
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $dbName = 'assignments';
      $connection = mysqli_connect($host, $user, $pass , $dbName) or die($connection); 
       $lsemailid = $_GET['emailid'];
       $checkAvailablity = "SELECT `securityQA` FROM `panel_mstr` WHERE `email_id` = '$lsemailid'";
       $resultCheckQuery = mysqli_query($connection,$checkAvailablity);
       if(mysqli_num_rows($resultCheckQuery) == 1)
       {
           $rows = mysqli_fetch_array($resultCheckQuery);
           $securityQA = $rows['securityQA'];
           $response = [
               "responseMSG" => "valid",
               "securityQA" => $securityQA
            ];
           response($response);
       }else{
              $response = [
                  "responseMSG" => "This Email Id Is Not Exist !"
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