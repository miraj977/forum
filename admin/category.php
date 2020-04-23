<?php include "header.php";?>

<div class="container" style="margin:8% auto;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Category</h3>
        </div> 
        <div class="panel-body">
           <a href="add-category.php" class="pull-right btn btn-success">Add New</a><br><br>
           <table class="table table-stripped">
            <th>Category Name</th>
            <th>Actions</th>
            <?php
            
            include "../functions/db.php";

            $sql = "SELECT * from category";
            $run = mysqli_query($con,$sql);

            while($row=mysqli_fetch_array($run))
            {
                extract($row);
                echo "<tr>";
                echo "<td>".$category."</td>";
                echo '<td><a href="edit-category.php?cat_id='.$cat_id.'"><button class="btn btn-default">Edit</button>
                <a href="delete-category.php?cat_id='.$cat_id.'" onclick="return confirm(\'Are you sure to delete this category?\')"><button class="btn btn-danger">Delete</button></a></td>';
                echo "</tr>";
            }
            

            ?>
        </table>
    </div>
</div>

</div>

</body>
</html>