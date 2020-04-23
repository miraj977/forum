<?php include "header.php";?>

<hr>
<div class="container" style="margin:2% auto;min-height:300px;">
    <h4><b><p style="margin-left: 10;">Latest Discussion</p></b></h4> 

    <?php  include "../functions/db.php";

    $sel = mysqli_query($con,"SELECT * from category");

    while($row=mysqli_fetch_assoc($sel)){
        extract($row);
        $sel2 = mysqli_query($con,"SELECT * from tblpost where cat_id='$cat_id' AND approve=1");
        $check=mysqli_fetch_assoc($sel2);
        echo '<div class=" col-md-12 col-sm-12" style="padding:1%;padding: 0;margin: 0;"><div class="panel panel-warning" >
        <div class="panel-heading" style="color:blak!important; background-color:orange!important;">
            <h3 class="panel-title" style="color: white;"><b>'.$category.'</b></h3>
        </div> 
        <div class="panel-body" style="padding-bottom: 0px;">';
            if(!empty($check['title']))
            {
                echo '<table class="table table-stripped">
                <tr style="background-color: aliceblue;">
                    <th>Topic Title</th>
                    <th>Content</th>
                    <th>Replies</th>
                    <th>Posted By</th>
                    <th>Date Added</th>
                    <th style="text-align:center">Views  &nbsp;<span class="glyphicon glyphicon-eye-open" style="font-size:12px;"></span></th>
                </tr>';
                $sel1 = mysqli_query($con,"SELECT * from tblpost where cat_id='$cat_id'  AND approve=1 ORDER BY post_Id DESC LIMIT 4");
                while($row1=mysqli_fetch_assoc($sel1)){
                    extract($row1);
                    $comcount=mysqli_query($con,"SELECT count(post_Id) as c from tblcomment where post_Id=$post_Id");
                    $count=mysqli_fetch_assoc($comcount);
                    extract($count);
                    echo '<tr class="clickable-row" data-href="content.php?post_id='.$post_Id.'" style="cursor:pointer;">';
                    echo '<td>'.$title.'</td>';
                    echo '<td>'.wordwrap(substr($content,0,30),50,"<br>\n")."...".'</td>';
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

                $sql=mysqli_query($con,"SELECT count(cat_id) AS cat from tblpost where cat_id=$cat_id");
                $count=mysqli_fetch_assoc($sql);
                extract($count);
                If(!empty($title) && $cat>4){                        
                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td><div class="pull-left"><a href="details.php?cid='.$cat_id.'"><button class="btn btn-default" style="background-color:orange;color:white;border-color: white;">View More +</button></a></div></td>';

                    echo '</tr>';
                }
                echo '</table>';
            }else{
                echo '<center><p style="font-size:20px;padding:30px;">No Post</p></center>';
            }
            echo '</div></div></div>';

        }
        ?>
        <div class="text-center center-block">
            <br />
            .
        </div>
        <?php include "footer.php";?>


        <a onclick="topFunction()" id="myBtn" title="Go to top" style="display: block;">Back to top</a>
        
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
            });
        </script>

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