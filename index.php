<?php

if($_SERVER["SCRIPT_URI"] == "http://www.everestviewtravels.com.au/forum/index.php" || $_SERVER["SCRIPT_URI"] == "www.everestviewtravels.com.au/forum/index.php"){
  header('Location: https://www.everestviewtravels.com.au/forum/index.php');
}

?>

<html>
<head>
  <title>Everest View Travel & Tours Forum</title>

  <!--Custom CSS-->
  <link rel="stylesheet" type="text/css" href="css/global.css">
  <!--Bootstrap CSS-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="favicon.png">

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <!--Script-->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-default">
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
        <a class="navbar-brand" href="pages/home.php" style="color:#ffa500;">Everest View Travel & Tours FORUM</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <!--
                <ul class="nav navbar-nav navbar-left">
                    <li><a href=""><span class="glyphicon glyphicon-list"></span> Topics</a></li>
                </ul>
              -->

              <div class="pull-right">
              <form class="navbar-form navbar-right" method="POST"role="search" action="pages/login.php">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="username" value="guest">
                    <input type="hidden" class="form-control" name="password" value="guest">
              <button type="submit"  class="btn btn-warning pull-right" style="background-color:orange;"><span class="fa fa-user"></span> Guest View</button>
              </div>
              </form><br>
              </div>

              <div>
                <form class="navbar-form navbar-right" method="POST"role="search" action="pages/login.php">
                  <div class="form-group">
                    <input type="text" class="form-control"  style="text-transform:lowercase;"   name="username"placeholder="Username" style="margin:8px 2px;">
                    <input type="password" class="form-control"  style="text-transform:lowercase;"  name="password"placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-success">Login</button>
                </form>
              </div>

            </div>
            <!-- /.navbar-collapse -->
          </div>
          <!-- /.container-fluid -->
        </nav><?php if(isset($_GET['success'])){?>
        <center><div class="alert alert-success alert-dismissable col-sm-6" style="left: 25%;">
          <strong>Registration successful !!</strong> Please login with your login credential.
        </div></center><?php }?>

        <?php if(isset($_GET['usererror'])){?>
        <center><div class="alert alert-danger alert-dismissable col-sm-6" style="left: 25%;">
          <strong>Username already taken !!</strong> Please enter another username.
        </div></center><?php }?>

        <?php if(isset($_GET['emailerror'])){?>
        <center><div class="alert alert-danger alert-dismissable col-sm-6" style="left: 25%;">
          <strong>Email already registered !!</strong> Please register another email address.
        </div></center><?php }?>

        <?php if(isset($_GET['error'])){?>
        <center><div class="alert alert-danger alert-dismissable col-sm-6" style="left: 25%;">
         Error occured.!!!
        </div></center><?php }?>

        <?php if(isset($_GET['forgot'])){?>
        <center><div class="alert alert-info alert-dismissable col-sm-6" style="left: 25%;">

          <strong>An email has been sent to your account with your login credentials. Thank you!!</strong>
        </div></center><?php }?>


        <div class="container" style="margin:8% auto;">

          <div class="col-sm-12 col-md-8 col-lg-8">
            <center>
              <img src="everestlogo.png" height:"50%" width="50%">
              <i><h2 style="color: #f7941e">Discuss with your friends</h2></i></center>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 ">
              <div class="row">

                <form method="POST" class="form-signin" action="functions/register.php">
                  <h3 class="text-center">Sign Up Here!</h3>
                  <input type="text" style="text-transform:capitalize;" name="fname"placeholder="First Name" class="form-control" required>
                  <input type="text" name="lname" style="text-transform:capitalize;" placeholder="Last Name" class="form-control" required>
                  <input type="email" name="email"  class="form-control" required placeholder="Email">
                  <input type="text" style="text-transform:lowercase;" placeholder="Username" name="username"class="form-control" required>
                  <input type="password" placeholder="Password"  style="text-transform:lowercase;" name="password" class="form-control" required>
                  <input type="submit" value="Sign Up" class="btn btn-success" style="width:100%;">
                </form>
                <center><a href="#" data-toggle="modal" data-target="#myModal">Forgot Password?</a></center>
              </div>
            </div>
          </div>
          <hr>
          <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Forgot password</h4>
                </div>
                <div class="modal-body">
                <form  method="POST" class="form-signin" action="functions/forgot.php">
                    <input type="text" style="text-transform:lowercase;" placeholder="Username" name="fusername"class="form-control" required>
                    <input type="email" name="femail"  class="form-control" required placeholder="Email">
                    <input type="submit" value="Send Email" class="btn btn-success" style="width:100%;">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>


        </body>
        </html>
