<?php include "header.php"; include "../functions/db.php";?>

<div class="container" style="margin:8% auto;width:900px;">

 <h2> New Event</h2>

 <hr>
 <div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Add New Event</h3>

  </div> 
  <div class="panel-body">
   <form method="POST" action="add-topic-function.php">
     <?php $cat=mysqli_query($con,"SELECT * FROM category;");?>
     <label>Event Title</label>
     <input type="text" class="form-control" name="title"required><br>
     <label>Content</label>
     <textarea name="content"class="form-control" rows="8" required></textarea><br>
     <label>Category</label>
     <select name="category" class="form-control">
      <?php 

      while ($c=mysqli_fetch_array($cat)){
        ?><option ><?php echo $c['category'];?></option>
        <?php } ?>
      </select><br>
      <input type="submit" class="btn btn-success pull-right" value="Add">
    </form>
  </div>
</div>
</body>
</html>