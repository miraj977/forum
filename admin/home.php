<?php include "header.php";?>

<div class="container" style="background-color:#e0bc00;min-height:82%">


  <div id="social-test" class="col-sm-12 col-md-12 col-lg-12">
    <center>
      <p style="font-family:forte;">Dashboard</p>
      <ul class="social">
        <div class="col-md-3">
          <li style="list-style:none;cursor:pointer;"><a href="post.php" title="Topics" style="color:black;"><i class="fa fa-book" aria-hidden="true"></i></a></li>
        </div>
        <div class="col-md-3">
          <li style="list-style:none;cursor:pointer;"><a href="user.php" title="User" style="color:black;"><i class="fa fa-group" aria-hidden="true"></i></a></li>
        </div>
        <div class="col-md-3">
          <li style="list-style:none;cursor:pointer;"><a href="category.php" title="Category" style="color:black;"><i class="fa fa-tags" aria-hidden="true"></i></a></li>
        </div>
        <div class="col-md-3">
          <li style="list-style:none;cursor:pointer;"><a href="approval.php" title="Approval" style="color:black;"><i class="fa fa-check" aria-hidden="true"></i></a></li>
          <?php    $sql=mysqli_query($con,"SELECT count(approve) as count from tblpost where approve=0");
          $c=mysqli_fetch_assoc($sql);
          extract($c);
          if($count){?>
          <p style="    background-color: red;
          color: white;
          border-radius: 170px;
          position: absolute;
          width: 42px;
          margin-top: -82px;
          margin-left: 105px;
          text-align: center;
          font-size: 28px;"><?php echo $count;?></p><?php }?>

        </div>
      </ul>
    </center>
   </div>
  </div>
</body>
</html