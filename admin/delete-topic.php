<?php
include "../functions/db.php";
  if(isset($_GET['post_Id'])){
		$id = $_GET['post_Id'];
	}
	if(empty($id)){
		echo("<script>location.href = 'index.php';</script>");
	}

	$run = mysqli_query($con,"DELETE FROM tblpost WHERE post_Id = '$id'")
	or die(mysqli_error());  	

	echo("<script>location.href = 'post.php';</script>");
	
?>