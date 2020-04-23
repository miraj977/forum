<?php
session_start();
if (isset($_SESSION['username'])&&$_SESSION['username']!=""){
}
else
{
  header("Location:../index.php");
}
$username=$_SESSION['username'];
$userid = $_SESSION['user_Id'];
include "../functions/db.php";
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


  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <!--Script-->
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

</head>
<body style="background-color:#333;">
	<!-- Navigation -->
  <nav class="navbar navbar-default ">
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
        <a class="navbar-brand" href="home.php" style="color:#ffa500;"><img src="../everestlogo.png" height="38px" width="54px" style="margin-top:-10;">&nbsp;<b>Everest View Travel & Tours FORUM</b></a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      
      
      
      

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!--
                <ul class="nav navbar-nav navbar-left">
                    <li><a href=""><span class="glyphicon glyphicon-list"></span> Topics</a></li>
                </ul>
              -->
              <div>
              <?php if($username!='guest'){?>
                 <ul class="nav navbar-nav navbar-right">
                   <li><button class="btn btn-warning pull-right" style="margin-top:5%; background-color:orange !important;margin-right: 24px;"><a href="#quest" style="text-decoration:none!important;color:white!important;">Post a Question</a></button></li>
                   <li style="padding-left:10px;"><a href="#" ><span class="glyphicon glyphicon-user"></span> <?php echo ucfirst($username);?></a></li>
                   <li  style="padding-left:10px;padding-right:30px;"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>                   
                </ul> 
              <?php }elseif($username=='guest'){?>
              <ul class="nav navbar-nav navbar-right">
                   <li  style="padding-left:10px;padding-right:30px;"><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>                   
                </ul> 

              <?php }?>
               </div>

             </div>
             <!-- /.navbar-collapse -->
           </div>
           <!-- /.container-fluid -->
         </nav>

         <div style="padding:1% 8%;">
          <!--  <div class="pull-left"><a href="home.php"><img src="../everestlogo.png" height="95" width="145"></a></div> -->
          
        </div><div style="clear:both;"></div>

        <div class="my-quest" id="quest">
          <div style="padding:1%;"> 
           <button type="button" class="close" data-dismiss="modal"><a href="" style="text-decoration:none;color:black;">&times;</a></button>
           <form method="POST" action="question-function.php">
            <h3>Add Question</h3>
            <label>Category</label>
            <select name="category" class="form-control">
              <?php $sel = mysqli_query($con,"SELECT * from category");

              if($sel==true){
                while($row=mysqli_fetch_assoc($sel)){
                  extract($row);
                  echo '<option value='.$cat_id.'>'.$category.'</option>';
                }
              }
              ?>
            </select>
            <label>Topic Title</label>
            <input type="text" class="form-control" name="title"required>
            <label>Content</label>
            <textarea name="content"class="form-control" rows="5"></textarea>
            <br>
            <input type="hidden" name="userid" value=<?php echo $userid; ?>>
            <input type="submit" class="btn btn-success pull-right" value="Post"> 
          </form>
          
        </div>
      </div>

      <div class="pull-right" style="margin-right:8%;">
       &nbsp;Jump to:<select class="form-control"  onchange="location = this.value;">
       <option value="home.php"><i>Select</i></option>
       <option value="home.php"><span class="fa fa-home">&#9751 Home</span></option>
       <?php $select = mysqli_query($con,"SELECT * from category");

       while($rows=mysqli_fetch_assoc($select)){
        extract($rows);?>
        <option value="details.php?cid=<?php echo $cat_id;?>"><?php echo $category;?></option>
        <?php }?></select></div>


<script type="text/javascript">
        $(function () {
    $(".close").on('click', function() {
        $('#quest').modal('hide');
            });
        });
</script>