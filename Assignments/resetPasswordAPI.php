<?php
//Database connection
header("Content-Type:application/json");
if((isset($_GET['emailid']) && $_GET['emailid']!="") && (isset($_GET['securityQA']) && $_GET['securityQA']!="") && (isset($_GET['securityAns']) && $_GET['securityAns']!="") && (isset($_GET['newPassword']) && $_GET['newPassword']!="")) 
    {
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $dbName = 'assignments';
      $connection = mysqli_connect($host, $user, $pass , $dbName) or die($connection); 
      $lsemailid = $_GET['emailid'];
      $lssecurityQA = $_GET['securityQA'];
      $lssecurityAns = md5($_GET['securityAns']); 
      $lsnewPassword = md5($_GET['newPassword']); 
      $resetQuery = "SELECT *FROM `panel_mstr` WHERE `email_id`='$lsemailid' AND `securityQA`='$lssecurityQA' AND `securityA`='$lssecurityAns'";
      $resetResult = mysqli_query($connection,$resetQuery);
      if(mysqli_num_rows($resetResult) == 1)
      {
             $updatePassword = "UPDATE `panel_mstr` SET `password` = '$lsnewPassword' WHERE `email_id`='$lsemailid' AND `securityQA`='$lssecurityQA' AND `securityA`='$lssecurityAns'";
             $resultUpdate = mysqli_query($connection,$updatePassword);
             $response = [
                 "responseMSG" => "reset"
             ];
             response($response);
      }else{
             $response = [
                  "responseMSG" => "Security Answer Is Not Valid !"
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