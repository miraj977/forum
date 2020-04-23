	<?php


	function dbcon(){
		$server = array('127.0.0.1','::1');
		if(!in_array($_SERVER['REMOTE_ADDR'], $server))
		{
			$host = "mysql-5.everestviewtravels.com.au";
			$user = "myword6815";
			$pwd = "oT8j74uu";
			$db = "dbforum";
		}
		else{
			$host = "localhost";
			$user = "root";
			$pwd = "";
			$db = "dbforum";
		}

		$con = mysqlii_connect($host,$user,$pwd,$db) or die ("ERROR Connecting to Database");

		$sel = mysqlii_select_db($con,$db);
	}

	function dbclose(){
		$server = array('127.0.0.1','::1');
		if(!in_array($_SERVER['REMOTE_ADDR'], $server))
		{
			$host = "mysql-5.everestviewtravels.com.au";
			$user = "myword6815";
			$pwd = "oT8j74uu";
			$db = "dbforum";
		}
		else{
			$host = "localhost";
			$user = "root";
			$pwd = "";
			$db = "dbforum";
		}

		$con = mysqli_connect($host,$user,$pwd,$db) or die ("ERROR Connecting to Database");

		$sel = mysqli_select_db($con,$db);

		mysqli_close($con);
	}

	function deleteuser($user_Id){
		dbcon();
		$sel = mysqli_query($con,"DELETE from tbluser where user_Id='$user_Id' ");

		if($sel==true){
			$del = mysqli_query($con,"DELETE from tblacct where user_Id='$user_Id' ");
				echo "success";
			
		}
		else{
			echo "failed";
		}

		dbclose();
	}

	function category(){
		dbcon();
		$sel = mysqli_query($con,"SELECT * from category");

		if($sel==true){
			while($row=mysqli_fetch_assoc($sel)){
				extract($row);
				echo '<option value='.$cat_id.'>'.$category.'</option>';
			}
		}


		dbclose();
	}

	?>

