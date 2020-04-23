 <?php
 include "db.php";

 $name=$_POST['fusername'];
 $femail=$_POST['femail'];
 $fusername = strtolower(str_replace("'","`",$name));
 $sql=mysqli_query($con,"SELECT `forgot` from tblaccount WHERE username='$fusername' AND email='$femail'");
 $s=mysqli_fetch_assoc($sql);
 extract($s);
 $semi_rand = md5(time()); 
 $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
 $headers = "From: info@everestviewtravels.com.au\r\n";
 $headers .= "MIME-Version: 1.0\r\n";
 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 $to =$femail;
 $subject= "Forgot Password";
 $message= "<html><body>Your request has been completed. Your login details are:</p>
 <p>Username: <b>$fusername</b><br>
  Password: <b>$forgot</b></p>
  
  <p>Regards,<br>
   Team Everest View</p></body></html>";

  mail($to,$subject,$message,$headers);
  echo '<meta http-equiv="refresh" content="0;url=../index.php?forgot" />'; 

  ?>