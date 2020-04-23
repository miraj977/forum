<?php include "header.php";?>
<div class="container" style="margin:0 auto;min-height:300px;">
 <!-- <h4>Details</h4> -->

 <br><br><br>
 <div class="panel panel-success">
  <div class="panel-heading" style="background-color:orange;color:white;padding-bottom:0px;">
    <?php 
    $id = $_GET['post_id'];
    $sqla="SELECT c.category from category as c, tblpost as t where c.cat_id=t.cat_id and t.post_Id=$id";
    $cat=mysqli_query($con,$sqla);
                //print_r($sql);exit();
    $c=mysqli_fetch_array($cat);
    ?>
    <h1 class="panel-title" style="font-size:20px !important;"><b><?php echo $c['category'];?></b></h1>
  </div> 


  <?php
  $sql = mysqli_query($con,"SELECT * from tblpost as tp join category as c on tp.cat_id=c.cat_id where tp.post_Id='$id' ");
  ?>
  <div class="panel-body"><?php
    if($sql==true){
      while($row=mysqli_fetch_assoc($sql)){
        extract($row);
        $view=0;
        
        $q=mysqli_query($con,"SELECT * from tblpost as tp join category as c on tp.cat_id=c.cat_id where tp.post_Id='$id' ");
        while($a=mysqli_fetch_assoc($q)){
          extract($a);
          $view=$view+1;
          $viewadd=mysqli_query($con,"UPDATE tblpost SET view=$view where post_Id=$id");
          $sel = mysqli_query($con,"SELECT * from tbluser where user_Id='$user_Id' ");
          //echo "SELECT * from tbluser where user_Id='$user_Id' ";
          $b=mysqli_fetch_assoc($sel);
          if($b){
          extract($b);//print_r($b);exit();
          echo "<label>Topic Title: </label> ".$title."<br>";
          echo "<label>Topic Category: </label> ".$category."<br>";
          echo "<label>Date time posted: </label> ".$datetime."<br>";
          echo "<p class='well' style='background-color: #f5f5f591 !important;border: 1px solid #e3e3e359 !important;'>".$content."</p>";
          echo '<label>Posted By: </label>'.' <b><i>'.$fname.' '.$lname.'</i></b>';
        }else{
          echo "<label>Topic Title: </label> ".$title."<br>";
          echo "<label>Topic Category: </label> ".$category."<br>";
          echo "<label>Date time posted: </label> ".$datetime;
          echo "<p class='well' style='background-color: #f5f5f591 !important;border: 1px solid #e3e3e359 !important;'>".$content."</p>";
          echo '<label>Posted By: </label>'.' <b><i>Admin</i></b>';

        }
      }

      


    }
  }


  $show=mysqli_query($con,"SELECT count(comment_Id) as com from tblcomment where post_Id=$id");
  $comment=mysqli_fetch_assoc($show);
  extract($comment);
  if($com>0){
    ?>

    <br><hr><h3><label>Comments</label></h3> <?php }?>
    <div id="comments">
      <?php 
      $postid= $_GET['post_id'];
      $sql = mysqli_query($con,"SELECT * from tblcomment as c join tbluser as u on c.user_Id=u.user_Id where post_Id='$postid' order by datetime");
      $num = mysqli_num_rows($sql);
      if($num>0){
        while($row=mysqli_fetch_assoc($sql)){

          if($row['user_Id']==$userid)
            {echo '<br><a href="#" class="btn btn-sm btn-danger pull-right" onclick="del('.$row['comment_Id'].')"><span class="glyphicon glyphicon-trash"></span></a>';}

          echo "<p class='well' style='background-color: #f5f5f591 !important;border: 1px solid #e3e3e359 !important;'>".$row['comment']."</p>";
          echo "<div class=\"pull-right\" style='margin-top: -16px !important;'><label>Comment by: </label> <b><i>".$row['fname']." ".$row['lname']."</b></i>";
          echo '<br><label class="pull-right" style="padding-right:5px;padding-left:3px;clear:both;font-weight:normal;background-color: #80808017;border-radius: 5px;">'.$row['datetime'].'</label>';
          
          echo "</div><br><br>";
        }

      }

      ?>
    </div>
  </div>
</div>

<?php if($username!='guest'){?>
<div class="col-sm-5 col-md-5 sidebar">
  <h3>Add a comment</h3>
  <form method="POST">
    <textarea type="text" class="form-control" id="commenttxt" rows=8></textarea><br>
    <input type="hidden" id="postid" value="<?php echo $_GET['post_id']; ?>">
    <input type="hidden" id="userid" value="<?php echo $_SESSION['user_Id']; ?>">
    <input type="submit" id="save" class="btn btn-warning pull-right" style="background-color:orange;" value="Comment">
  </form>
</div>
<?php }?>

<div class="text-center center-block">
  <br />
</div>
</div><?php include "footer.php";?>


</body>
<script>

  $("#save").click(function(){
    var postid = $("#postid").val();
    var userid = $("#userid").val();
    var comment = $("#commenttxt").val();
    var datastring = 'postid=' + postid + '&userid=' + userid + '&comment=' + comment;
    if(!comment){
      alert("Please enter some text comment");
    }
    else{

      $.ajax({
        type:"POST",
        url: "../functions/addcomment.php",
        data: datastring,
        cache: false,
        success: function(result){
          document.getElementById("commenttxt").value=' ';
          $("#comments").append(result);
        }
      });
    }
    return false;
  })
</script>

<script type="text/javascript">
  function del(id)
  {
    var c=confirm("Are you sure?");
    if(c==true){
      $.ajax({
        type:"POST",
        url: "../functions/addcomment.php",
        data: 'id=' + id,
        success: function(result){
          location.reload();
          //alert(id);
        }
      });
    }}
  </script>
  </html>