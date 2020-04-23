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
  }
  if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $title =  mysqli_real_escape_string($con,$_POST['title']);
    $content = mysqli_real_escape_string($con,$_POST['content']);
    $act=$_POST['category'];
    $catname = mysqli_query($con,"SELECT cat_id from category where category='$act'");
    $row = mysqli_fetch_array($catname);
    $datetime =mysqli_real_escape_string($con,$_POST['datetime']);
    $c= $row['cat_id'];
    $sqli = "UPDATE `tblpost` SET `title`='$title',`content`='$content',`cat_id`=$c,`datetime`='$datetime' WHERE `post_Id`='$id'";
                    //print_r($sqli);exit();
    $runs=mysqli_query($con,$sqli);
                    //exit();
    echo("<script>location.href = 'post.php';</script>");                                  
    
  }
  ?>
  
  <form method="POST" action="edit-topic.php?edit=<?php echo $id;?>">
    <?php $cat=mysqli_query($con,"SELECT * FROM CATEGORY;");?>
    <input type="hidden" name="post_Id" value="<?php echo $id;?>">
    <input type="text" name="title" class="form-control" value="<?php echo $title;?>"><br>
    <textarea name="content"class="form-control"><?php echo $content;?></textarea><br>

    <select name="category" class="form-control">
      <?php 

      while ($c=mysqli_fetch_array($cat)){
        $sql = "SELECT * FROM tblpost as tp join category as c on tp.cat_id=c.cat_id WHERE tp.post_Id='$id'";
        $run = mysqli_query($con,$sql);

        while($row=mysqli_fetch_array($run))
        {
          $category= $row['category'];
          if($c['category']==$category){
            ?>
            <option selected><?php echo $c['category'];?></option>
            <?php }
            else
              {?><option ><?php echo $c['category'];?></option>
            <?php }
          }}
          ?>
          
        </select><br>
        <input type="text" class="form-control" name="datetime" value="<?php echo $datetime;?>"><br>
        <input type="submit" name="edit" class="btn btn-success pull-right" value="Update">
        
      </form>
      
    </div>
  </div>
</body>
</html>