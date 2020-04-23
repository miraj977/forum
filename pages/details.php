<?php include "header.php";?>
<hr>
<div class="container" style="margin:2% auto;min-height:300px;">
   <?php
   $cid=$_GET['cid'];
   $sel = mysqli_query($con,"SELECT * from category where cat_id=$cid");
   while($row=mysqli_fetch_assoc($sel)){
    extract($row);
    echo '<div class=" col-md-12 col-sm-12" style="padding:1%"><div class="panel panel-warning" >
    <div class="panel-heading" style="color:blak!important; background-color:orange!important;color:white;">
        <h3 class="panel-title"><b>'.$category.'</b></h3>
    </div> 
    <div class="panel-body">
        <table class="table table-stripped">
            <tr style="background-color: aliceblue;">
                <th>Topic Title</th>
                <th>Content</th>
                <th>Replies</th>
                <th>Posted By</th>
                <th>Date Added</th>
                <th style="text-align:center">Views  <span class="glyphicon glyphicon-eye-open" style="font-size:12px;"></span></th>
            </tr>';

            $sel1 = mysqli_query($con,"SELECT * from tblpost where cat_id='$cat_id'");
            while($r=mysqli_fetch_assoc($sel1)){ 
                    //print_r($r);
                if($cat_id=$r['cat_id'])
                {   
                    extract($r);
                    $comcount=mysqli_query($con,"SELECT count(post_Id) as c from tblcomment where post_Id=$post_Id");

                    echo '<tr class="clickable-row" data-href="content.php?post_id='.$post_Id.'" style="cursor:pointer;">';
                    echo '<td>'.$title.'</td>';
                    echo '<td>'.wordwrap(substr($content,0,30),50,"<br>\n")."...".'</td>';
                    $count=mysqli_fetch_assoc($comcount);
                    extract($count);
                    if($c==0){
                        echo '<td>NA</td>';
                    }
                    else{
                        echo '<td>'.$c.'</td>';
                    }
                    $usersql=mysqli_query($con,"SELECT * from tbluser where user_Id=$user_Id");
                        //print_r($usersql); 
                    $user=mysqli_fetch_assoc($usersql);
                    if($user)
                    {
                        extract($user);
                        echo '<td><i>'.$fname.' '.$lname.'</i></td>';
                    }
                    else
                    {
                        echo '<td><i> Admin</i></td>';
                    }

                    echo '<td>'.$datetime.'</td>';
                        // echo '<td><div class="pull-left"><a href="content.php?post_id='.$post_Id.'"><button class="btn btn-warning">View</button></div></td>'; 
                    if($view!=0)
                        {echo '<td style="text-align:center">'.$view.'</td>';}
                    else{ echo '<td style="text-align:center">NA</td>';}                                            
                    echo '</tr>';
                }

            }
            $post=mysqli_query($con,"SELECT post_Id from tblpost where cat_id=$cat_id");
            $pt=mysqli_fetch_assoc($post);
            if(is_null($pt)){
                echo '<tr><td></td>
                <td></td>
                <td></td>
                <td><p style="font-size:20px;margin-top:20px;">No Post</p></td></tr>';
            }
            echo '</table></div></div></div></div>';

        }
        ?><br>
        <div class="text-center center-block">
            <br />
            .
        </div>
        <?php include "footer.php";?>    

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
            });
        </script>

    </body>
    </html>