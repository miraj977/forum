<?php
session_start();
if (isset($_SESSION['uname'])&&$_SESSION['uname']!=""){
}
else
{
  echo("<script>location.href = 'index.php';</script>");
}
$username=$_SESSION['uname'];
include"../functions/db.php";

?>
<html>
<head>
	<title>Everest View Travel & Tours Forum</title>

	<!--Custom CSS-->
	<link rel="stylesheet" type="text/css" href="../css/global.css">
	<!--Bootstrap CSS-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../favicon.png">
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
 <!--Script-->
 <script src="../js/jquery.js"></script>
 
</head>
<body>
	<!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top navbar-collapse">
    <div class="container">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand page-scroll" href="home.php"></a>
      </div>
      <div class="navbar-header">
        <a class="navbar-brand" href="home.php">Admin Dashboard</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <?php 
        $sql=mysqli_query($con,"SELECT count(approve) as count from tblpost where approve=0");
        $c=mysqli_fetch_assoc($sql);
        extract($c);

        ?>
        
        <ul class="nav navbar-nav navbar-left" id="menu">
          <li><a href="post.php">Topics</a></li>
          <li><a  href="user.php">Users</a></li>
          <li><a  href="category.php">Category</a></li>
          <?php if($count){?>
          <li><a  href="approval.php">Approval <p style="background-color: red;
            color: white;
            border-radius: 45px;
            position: absolute;
            width: 21px;
            margin-top: -28px;
            margin-left: 56px;
            text-align: center;"><?php echo $count;?></p></a></li>
            <?php }else{?><li><a  href="approval.php">Approval</a></li><?php }?>
          </ul>
          <script type="text/javascript">
            $("#menu li a").click(function() {
              $(this).addClass('selected');

            });
          </script>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" ><span class="glyphicon glyphicon-user"></span> <?php echo ucfirst($username);?></a></li>
            <li ><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>