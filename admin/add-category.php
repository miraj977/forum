<?php include "header.php";?>

<div class="container" style="margin:8% auto;width:900px;">

 <h2>Category</h2>

 <hr>
 <div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Add New Category</h3>

  </div> 
  <div class="panel-body">
   <form method="POST" action="add-category-function.php">

    <label>Category</label>
    <input type="text" class="form-control" name="category" required style="width:50%">

    <input type="submit" class="btn btn-success pull-right" value="Add">
  </form>
</div>
</div>
</body>
</html>