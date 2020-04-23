<?php
session_start();
include "../functions/db.php";
$datetime=mysqli_real_escape_string($con,date("d M Y h:i: a"));
$title =  mysqli_real_escape_string($con,$_POST['title']);
$content = mysqli_real_escape_string($con,$_POST['content']);
$user_Id = $_SESSION['user'];
$cat=$_POST['category'];
$cat_id=mysqli_query($con,"SELECT cat_id from category where category=\"$cat\"");
while($row=mysqli_fetch_array($cat_id))
$c=$row['cat_id'];
$sql = "INSERT INTO tblpost (title, content, cat_id, datetime , user_Id) VALUES ('$title','$content','$c','$datetime','$user_Id')";
//print_r($sql);print_r($_SESSION['user_Id']);exit();
$res = mysqli_query($con,$sql);
echo("<script>location.href = 'post.php';</script>");
?>