<?php include "header.php";?>
<div class="pull-right" style="margin-right:8%;">
   &nbsp;Filter by<span class="glyphicon glyphicon-filter"></span><br>
   <div style="display:inline-flex;">
       <select class="form-control"  onchange="location = this.value;">
           <option value="home.php"><i>Category</i></option>
           <option value="home.php">&#9751 Home</option>
           <?php $select = mysqli_query($con,"SELECT * from category");

           while($rows=mysqli_fetch_assoc($select)){
            extract($rows);?>
            <option value="post.php?cid=<?php echo $cat_id;?>"><?php echo $category;?></option>
            <?php }?></select>&nbsp;
            <select class="form-control"  onchange="location = this.value;">
               <option value="home.php"><i>Status</i></option>
               <option value="home.php">&#9751 Home</option>
               <option value="post.php?status=1">Approved</option>
               <option value="post.php?status=2">Disapproved</option>
               <option value="post.php?status=0">Pending</option>
           </select>
       </div>
   </div>
   <div class="container" style="margin:8% auto;width:auto;padding: 0% 10%">

     <h2> Topics Posted</h2>
     <hr>           
     <a href="add-topic.php" class="pull-right btn btn-success">Add New</a><br/><br/>
     <div class="panel panel-primary">
        <div class="panel-heading">
            <?php if(isset($_GET['cid'])){
                $catid=$_GET['cid'];
                    //echo $catid;
                $category=mysqli_query($con,"SELECT category from category where cat_id=$catid;");
                $catname=mysqli_fetch_assoc($category);
                extract($catname);
                $postcount=mysqli_query($con,"SELECT count(post_Id) as count from tblpost where cat_id=$catid;");
                $sql=mysqli_fetch_assoc($postcount);
                extract($sql);
                ?>
                <h3 class="panel-title">List of Topics Posted on <b><i><?php echo $category;?></i></b> <p class="pull-right"><strong>Total: <?php echo $count;?> post/s</strong></p></h3>
                <?php }else{?>
                <h3 class="panel-title">List of Topics Posted</h3>
                <?php }?>

            </div> 
            <div class="panel-body">

             <table class="table table-stripped" width="100%">
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
                <?php

                include "../functions/db.php";


                if(isset($_GET['cid']))
                { 
                    $cat=$_GET['cid'];
                    $sql = "SELECT * FROM tblpost as tp join category as c on tp.cat_id=c.cat_id where tp.cat_id=$cat ORDER by post_Id DESC";
                    $run = mysqli_query($con,$sql);
                }elseif(isset($_GET['status'])){
                    $status=$_GET['status'];
                    $sql = "SELECT * FROM tblpost as t, category as c where t.approve=$status AND t.cat_id=c.cat_id ORDER by post_Id  DESC";
                    $run = mysqli_query($con,$sql);
                }else{
                    $sql = "SELECT * FROM tblpost as tp join category as c on tp.cat_id=c.cat_id ORDER by post_Id  DESC";
                    $run = mysqli_query($con,$sql);
                }

                while($row=mysqli_fetch_array($run))
                {
                    $id = $row['post_Id'];
                    echo "<tr>";
                    echo "<td style='width:20%;'>".$row['title']."</td>";
                    echo "<td style='width:25%;'>".wordwrap(substr($row['content'],0,100),50,"<br>\n")."..."."</td>";
                    echo "<td>".$row['category']."</td>";
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
               echo "<td>".
               "<a href='topic-details.php?post_Id=$id' class='btn btn-default'><span class=\"glyphicon glyphicon-tasks\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Details\" ></a>"." ".
               "<a href='edit-topic.php?post_Id=$id' class='btn btn-default'><span class=\"glyphicon glyphicon-edit\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\"></span></a>"." ".
               "<a href='delete-topic.php?post_Id=$id' onclick=\"return confirm('Are you sure to delete the post?')\"class='btn btn-default'><span class=\"glyphicon glyphicon-remove-sign\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"></a>"
               ."</td>";
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