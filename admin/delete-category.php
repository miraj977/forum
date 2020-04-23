<?php
include "../functions/db.php";
  if(isset($_GET['cat_id'])){
		$id = $_GET['cat_id'];
	}
	if(empty($id)){
		echo("<script>location.href = 'index.php';</script>");
	}

	$run = mysqli_query($con,"DELETE FROM category WHERE cat_id = '$id'")
	or die(mysqli_error());  	

	echo("<script>location.href = 'category.php';</script>");
	
?>