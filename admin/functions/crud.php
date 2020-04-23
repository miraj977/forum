<?php
include "functions.php";
include "../../functions/db.php";

if(isset($_POST['delid']))
{
  $del = $_POST['delid'];

  $sql=mysqli_query($con,"DELETE FROM `tbluser` WHERE user_Id=$del");
  $sql2=mysqli_query($con,"DELETE from tblaccount where user_Id=$del");
  }
//print_r($_POST);exit();
  if((isset($_POST['uname'])) && (isset($_POST['lname'])) && (isset($_POST['fname'])))
  {
    $uname=strtolower($_POST['uname']);
    $fname=ucfirst($_POST['fname']);
    $lname=ucfirst($_POST['lname']);
    $uid=$_POST['uid'];

    $user=mysqli_query($con,"UPDATE `tbluser` SET `fname`='$fname',`lname`='$lname' WHERE user_Id=$uid");
    $name=mysqli_query($con,"UPDATE `tblaccount` SET `username`='$uname' WHERE user_Id=$uid");
    echo("<script>location.href = '../user.php';</script>");
  }

  if(isset($_GET['approve']))
  {
    $approve=$_GET['approve'];
    $sql=mysqli_query($con,"UPDATE tblpost SET approve=1 where post_Id=$approve");
    echo("<script>location.href = '../approval.php';</script>");
  }
  
  if(isset($_GET['disapprove']))
  {
    $disapprove=$_GET['disapprove'];
    $sql=mysqli_query($con,"UPDATE tblpost SET approve=2 where post_Id=$disapprove");
    echo("<script>location.href = '../approval.php';</script>");
  }
  if(isset($_GET['delete']))
  {
    $delete=$_GET['delete'];
    echo "<script>confirm('Are you sure?');</script>";
    if(true){
      $sql=mysqli_query($con,"DELETE FROM tblpost where post_Id=$delete");
    }
    echo("<script>location.href = '../approval.php';</script>");
  }
  ?>