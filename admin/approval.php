<?php include "header.php";include "../functions/db.php";?>

<?php $select = mysqli_query($con,"SELECT * from category");

        while($rows=mysqli_fetch_assoc($select)){
            extract($rows);?>
         <!-- <option value="post.php?cid=<?php echo $cat_id;?>"><?php echo $category;?></option> -->
            <?php }?>
        </select></div>
        <div class="container" style="margin:8% auto;width:auto;padding: 0% 10%">

         <h2> Posts for Approval</h2>
         <hr>
         <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List of Pending Posts</h3>
            </div>
            <div class="panel-body">

             <table class="table table-stripped">
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
                <?php

                $sql = "SELECT * FROM tblpost WHERE approve=0 order by post_Id desc";
                $run = mysqli_query($con,$sql);

                while($row=mysqli_fetch_array($run))
                {
                    $id = $row['post_Id'];
                    $cats=mysqli_query($con,"SELECT * from tblpost as t, category as c WHERE t.post_Id=$id AND t.cat_id=c.cat_id");
                    $r=mysqli_fetch_assoc($cats);
                    echo "<tr>";
                    echo "<td>".$row['title']."</td>";
                    echo "<td>".wordwrap(substr($row['content'],0,100),50,"<br>\n")."..."."</td>";
                    echo "<td>".$r['category']."</td>";
                    echo "<td>".$row['datetime']."</td>";
                    if($row['approve']==1)
                    {
                        echo "<td><p style='background-color:#5cb85c;border-radius:5px;color:white;text-align: center;padding: 4px;'>Approved</p></td>";
                    }elseif ($row['approve']==2) {
                     echo "<td><p style='background-color:#dc2759;border-radius:5px;color:white;text-align: center;padding: 4px;'>Disapproved</p></td>";
                 }else
                 {
                   echo "<td><p style='background-color:#4c4346;border-radius:5px;color:white;text-align: center;padding: 4px;'>Pending</p></td>";
               }
               echo "<td>";?>
               <select class="form-control" onchange="location = this.value;">
                <option>Select</option>
                <option value="functions/crud.php?approve=<?php echo $id;?>">Approve</option>
                <option value="functions/crud.php?disapprove=<?php echo $id;?>">Disapprove</option>
                <option value="functions/crud.php?delete=<?php echo $id;?>">Remove</option>
            </select>

            <?php
            echo "</td>";
            echo "</tr>";
        }


        ?>
    </table>
</div>
</div>
</div>
<a onclick="topFunction()" id="myBtn" title="Go to top" style="display: block;">Back to top</a>
<script>

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }


    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

</body>
</html>
