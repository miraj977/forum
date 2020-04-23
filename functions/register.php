<?php
include "db.php";

extract($_POST);

  $fname = ucfirst(str_replace("'","`",$fname));
  $fname = mysqli_real_escape_string($con,$fname);

  $lname = ucfirst(str_replace("'","`",$lname));
  $lname = mysqli_real_escape_string($con,$lname);

  $username = strtolower(str_replace("'","`",$username));
  $username = mysqli_real_escape_string($con,$username);

  $password = str_replace("'","`",$password);
  $password = mysqli_real_escape_string($con,$password);
  $forgot = $password = mysqli_real_escape_string($con,$password);
  $password = md5($password);



$sql = "INSERT INTO `tbluser`(`fname`, `lname`) VALUES ('$fname','$lname')";
$result = mysqli_query($con,$sql);

 if($result)
  {
    $a = mysqli_query($con,"SELECT * FROM `tbluser` WHERE `fname` = '$fname' AND `lname`='$lname'");
    $aa = mysqli_fetch_array($a);

    if($a)
    {
      $aaa = $aa['user_Id'];
      $sql_u="SELECT * FROM tblaccount WHERE `username`='$username'";
      $sql_e="SELECT * FROM tblaccount WHERE `email`='$email'";
      //echo $sql_u;exit;
      $res_u = mysqli_query($con, $sql_u);
      $res_e = mysqli_query($con, $sql_e);

      if (mysqli_num_rows($res_u) > 0) {
      echo '<meta http-equiv="refresh" content="0;url=../index.php?usererror" />';
      }else if(mysqli_num_rows($res_e) > 0){
      echo '<meta http-equiv="refresh" content="0;url=../index.php?emailerror" />';
      }else{

      $sql = "INSERT INTO `tblaccount`(`username`, `password`, `user_Id`, `forgot`, `email`) VALUES('$username','$password',$aaa,'$forgot','$email')";
      //echo $sql;exit;
      $res = mysqli_query($con,$sql);

      if($res==true)
                            {

                              $semi_rand = md5(time());
                              $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
                              $headers = "From: info@everestviewtravels.com.au\r\n";
                              $headers .= "MIME-Version: 1.0\r\n";
                              $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                              $to =$email;
                              $subject= "Successfully Registered to Everest View Travel & Tours Forum";
                              $message.= "<html><body>Congratulations!!! <p>You have successfully registed to our forum. You can now login and check the posts as well as submit your queries. Your login details are:</p>
                              <p>Firstname:<b> $fname</b><br>
                              Lastname:<b> $lname</b><br>
                              Username:<b> $username</b><br>
                              Password:<b> $forgot</b></p>

                              <p>Regards,<br>
          Team Everest View</p></body></html>";

                              mail($to,$subject,$message,$headers);


                                   echo '<script language="javascript">';
                                    //echo 'alert("Successfully Registered. Please login with your details.")';
                                    echo '</script>';
                                    echo '<meta http-equiv="refresh" content="0;url=../index.php?success" />';
                            }

    }
    }

  }?>
