$(window).ready(function()
{
   $("#id1").click(function()
   {
       $(".myPage").hide();
       $("#registerPanel").show();
   });
   $("#id2").click(function()
   {
       $(".myPage").hide();
       $("#loginPanel").show();
   });
   $("#id3").click(function()
   {
       $(".myPage").hide();
       $("#socialPanel").show();
   });
   $("#id4").click(function()
   {
       $(".myPage").hide();
       $("#resetPanel").show();
   });
   //api for register
   $("input[name='register']").click(function(e)
   {
        e.preventDefault();
        let lsemailid = $("input[name='email']").val();
        let lspassword = $("input[name='password']").val();
        let lsselectedQA = $("select[name='securityQA']").val();
        let lsselectedA = $("input[name='question'").val();
        if(lsemailid != "" && lspassword != "" && lsselectedQA != "default" && lsselectedA != "")
        {
            let url = "http://localhost/Assignments/registerAPI.php?emailid="+lsemailid+"&password="+lspassword+"&securityQA="+lsselectedQA+"&securityA="+lsselectedA;
            panelAPI(url);
        }else{
              $(".notification").show();
              $("#alert").text("Please Fill The All Input Field !");
              $(".notification").fadeOut(10000);
        };
   });
   //LOGIN api
   $("input[name='login']").click(function(e)
   {
         e.preventDefault();
         let lsemailid = $("input[name='emailId'").val();
         let lspassword = $("input[name='passwordse'").val();
         if(lsemailid != "" && lspassword != "")
         {
            let url = "http://localhost/Assignments/loginAPI.php?emailid="+lsemailid+"&password="+lspassword;
            panelAPI(url);
         }else{
            $(".notification").show();
            $("#alert").text("Please Fill The All Input Field !");
            $(".notification").fadeOut(10000);
      };
   });
   //email vvalid check api
   $("input[name='emailvalid']").click(function(e)
   {
       e.preventDefault();
       let lsemailid = $("input[name='emailchk']").val();
       if(lsemailid != "")
       {
           let url = "http://localhost/Assignments/emailvalidAPI.php?emailid="+lsemailid;
           panelAPI(url);
       }else{
              $(".notification").show();
              $("#alert").text("Please Fill The All Input Field !");
              $(".notification").fadeOut(10000);
            };
   });
   //reset password
   $("input[name='resetPassword']").click(function(e)
   {
      e.preventDefault();
      let lsemailid = $("input[name='emailchk']").val();
      let lssecurityQA = $("select[name='securitysQAA']").val();
      let lssecurityAns = $("input[name='securityAnss']").val();
      let lsnewpassword = $("input[name='passwordsee']").val();
      let url = "http://localhost/Assignments/resetPasswordAPI.php?emailid="+lsemailid+"&securityQA="+lssecurityQA+"&securityAns="+lssecurityAns+"&newPassword="+lsnewpassword;
      panelAPI(url);
   });
   //rest API
   function panelAPI(url)
   {
    var panelRequest = new XMLHttpRequest();     //hit the server and authenticate the user valid or not
    let panelAPI = url;
    panelRequest.onreadystatechange = function()
    {
     if(this.readyState == 4 && this.status == 200) 
     {                  
        console.log('Response Text:' + panelRequest.responseText);
        try 
           {
             let response = JSON.parse(panelRequest.responseText);   //here fetch all sitt
             if(response.responseMSG == "valid")
             {
                 //$("select[name='securitysQA']").css({"disabled":"false"});
                 $("select[name='securitysQAA']")[0].disabled = false;
                 $("select[name='securitysQAA']").val(response.securityQA);
                 $("input[name='securityAnss']")[0].disabled = false;
                 $("input[name='passwordsee']")[0].disabled = false;
                 $("input[name='resetPassword']")[0].disabled = false;
                 $("input[name='resetPassword']").css({"border":"solid rgb(1, 83, 97) 1px","background-color": "rgb(1, 83, 97)","cursor":"pointer"});
                 $("input[name='emailvalid']").css({"border":"solid #626262 1px","background-color": "#626262","cursor":"not-allowed"});
                 $("input[name='emailvalid']")[0].disabled = true;
             }else if(response.responseMSG == "reset")
             {
                $(".notification").show();
                $("#alert").text("Successfully Changed Password");
                let t1 = setTimeout(function()
                {
                    window.location.reload();
                    clearTimeout(t1);
                },5000);
             }else{
                $(".notification").show();
                $("#alert").text(response.responseMSG);
                $(".notification").fadeOut(10000);
             };
           }catch(ex)
                 {
                   console.log("Error : "+ex.message + " in " + panelRequest.responseText);
                 };
     };
    };
    panelRequest.open("GET",panelAPI,true);
    panelRequest.send();
   };
});