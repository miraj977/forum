<?php
include "db.php";

$comment = mysqli_real_escape_string($con,$_POST['comment']);
$userid = $_POST['userid'];
$postid = $_POST['postid'];
$datetime= date('Y-m-d H:i:s');

$comment = mysqli_query($con,"Insert into tblcomment (comment,post_Id,user_Id,datetime) values ('$comment','$postid','$userid','$datetime') ");

$sql =
mysqli_query($con,"SELECT * from tblcomment as c join tbluser as u on
c.user_Id=u.user_Id where post_Id='$postid' and c.user_Id='$userid' and
c.datetime='$datetime'");

while($row=mysqli_fetch_assoc($sql)){ {echo '<br><a href="#" class="btn btn-sm
btn-danger pull-right" onclick="del('.$row["comment_Id"].')"><span
class="glyphicon glyphicon-trash"></span></a>';}

  echo "<p class='well' style='background-color: #f5f5f591 !important;border:
  1px solid #e3e3e359 !important;'>".$row['comment']."</p>"; echo "<div
  class=\"pull-right\" style='margin-top: -16px !important;'><label>Comment by:
  </label> <b><i>".$row['fname']." ".$row['lname']."</b></i>"; echo '<br><label
  class="pull-right"
  style="padding-right:5px;padding-left:3px;clear:both;font-weight:normal;background-color:
  #80808017;border-radius: 5px;">'.$row['datetime'].'</label>';

  echo "</div><br>";
}

if(isset($_POST['id'])) {
    $del=$_POST['id'];
    $sql=mysqli_query($con,"DELETE from tblcomment where comment_Id=$del ");
}

if($_GET['forgot']) {
    $name=$_POST['fusername'];
    $femail=$_POST['femail'];
$fusername = strtolower(str_replace("'","`",$name));
$sql=mysqli_query($con,"SELECT forgot from tblaccount WHERE
username='$fusername' AND email='$femail'"); $s=mysqli_fetch_assoc($sql);
extract($s); $semi_rand = md5(time()); $mime_boundary =
"==Multipart_Boundary_x{$semi_rand}x"; $headers = "From:
info@everestviewtravels.com.au"; $headers .= "MIME-Version: 1.0\r\n"; $headers
.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                              $to =$email; $subject= "Forgot Password";
                              $message.= "<html><body>Your login details
                              are:</p> <p>Username: <b>$fusername</b><br>
                              Password: <b>$forgot</b></p><br>

                              <p>Regards,</p> <p>Team Everest
                              View</p></body></html>";

                              mail($to,$subject,$message,$headers); echo '<meta
                              http-equiv="refresh"
                              content="0;url=../index.php?forgot" />';

  } ?>
