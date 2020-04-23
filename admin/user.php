<?php include "header.php";?>

<div class="container" style="margin:8% auto;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Users</h3>
        </div> 
        <div class="panel-body">
            <table class="table table-stripped">
                <th>Username</th>
                <th>Name</th>
                <th>Actions</th>
                <?php

                include "../functions/db.php";

                $sql = "SELECT * from tbluser as tu join tblaccount as ta on tu.user_Id=ta.user_Id";
                $run = mysqli_query($con,$sql);

                while($row=mysqli_fetch_array($run))
                {
                    extract($row);
                    echo "<tr>";
                    echo "<td>".$username."</td>";
                    echo "<td>".$fname.' '.$lname."</td>";
                    echo '<td><a href="edituser.php?uid='.$user_Id.'"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" onclick="deleteuser('.$user_Id.')">Delete</button>';
                    echo "</tr>";
                }              
                ?>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deleteuser(user_Id){
        var delid = user_Id;
        var con = confirm("Are you sure you want to delete?");
        if(con==true){
            $.ajax({
                type: "POST",
                url: "functions/crud.php",
                data: 'delid='+delid,
                success: function(result){
                        location.reload();
                    
                }
            });
        }

        return false;
    }

</script>
</body>
</html>