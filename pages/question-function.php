<?php

include "../functions/db.php";
$datetime= date('Y-m-d H:i:s');

extract($_POST);
$title=mysqli_real_escape_string($con,$title);
$content=mysqli_real_escape_string($con,$content);

$sql = "INSERT INTO tblpost(title,content, cat_id,datetime,user_Id,approve) VALUES ('$title','$content','$category','$datetime','$userid','0')";
//echo $sql;exit;
$res = mysqli_query($con,$sql);

if($res)
{
 echo '<meta http-equiv="refresh" content="0;url=home.php" />';
 echo '<script language="javascript">';
 echo 'alert("Your post has been successfully submitted and will be displayed in the forum once approved by the Admin. Thank You!!!")';
 echo '</script>';

}
else{
	echo '<script language="javascript">';
    echo 'alert("Please try again.")';
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0;url=home.php" />';
}

?>
