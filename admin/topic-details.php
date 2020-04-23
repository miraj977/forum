<?php include "header.php";?>
<div class="container" style="margin:8% auto;width:900px;">

 <h2> Topics Posted</h2>

 <hr>
 <div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Topic Details</h3>

  </div> 
  <div class="panel-body">

    <?php
    include "../functions/db.php";
    if(isset($_GET['post_Id'])){
     $id = $_GET['post_Id'];
   }
   if(empty($id)){
    echo("<script>location.href = 'post.php';</script>");
  }

  $sql = "SELECT * FROM tblpost as tp join category as c on tp.cat_id=c.cat_id WHERE tp.post_Id='$id'";
  $run = mysqli_query($con,$sql);

  while($row=mysqli_fetch_array($run))
  {
    $id = $row['post_Id'];

    $title = $row['title'];
    $content = $row['content'];
    $category= $row['category'];
    $datetime =$row['datetime'];

  }

  ?>

  <form>
    <label>Title</label>
    <input   type="text" class="form-control" value="<?php echo $title;?>"><br>
    <label>Content</label>
    <textarea  name="content"class="form-control well"><?php echo $content;?></textarea><br>
    <label>Category</label>
    <input   type="text" class="form-control well" value="<?php echo $category;?>"><br>
    <label>Date</label>
    <input   type="text" class="form-control well" value="<?php echo $datetime;?>">
    <?php 
    $sql = mysqli_query($con,"SELECT * from tblcomment as c join tbluser as u on c.user_Id=u.user_Id where post_Id='$id' order by datetime");
    $num = mysqli_num_rows($sql);
    if($num>0){
      while($row=mysqli_fetch_assoc($sql)){


       echo '<br><a href="#" class="btn btn-sm btn-danger pull-right" onclick="del('.$row['comment_Id'].')"><span class="glyphicon glyphicon-trash"></span></a>';

       echo "<p class='well' style='background-color: #f5f5f591 !important;border: 1px solid #e3e3e359 !important;'>".$row['comment']."</p>";
       echo "<div class=\"pull-right\" style='margin-top: -16px !important;'><label>Comment by: </label> <b><i>".$row['fname']." ".$row['lname']."</b></i>";
       echo '<br><label class="pull-right" style="padding-right:5px;padding-left:3px;clear:both;font-weight:normal;background-color: #80808017;border-radius: 5px;">'.$row['datetime'].'</label>';
       
       echo "</div><br>";}}
       ?>

     </form>
     <center><a href="#"  onclick="javascript:history.go(-1);"><button class="btn btn-danger">Back</button></a></center><br>
   </div>
 </div>
</body>
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