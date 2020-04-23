<?php

$server = array('127.0.0.1','::1');

if(!in_array($_SERVER['REMOTE_ADDR'], $server)){
$host = "sql209.epizy.com";
$dbname = "epiz_25072193_forum";
$udb = "epiz_25072193";
$pdb = "P690mXAg1Y2TX3Y";


$con = mysqli_connect($host,$udb,$pdb,$dbname);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $selected = mysqli_select_db($con,$dbname)
    or die("Could not connect db");
}
else
{
    $con = new mysqli("localhost","root","root","dbforum");
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    $selected = mysqli_select_db($con,"dbforum")
    or die("Could not  connect db");
    // echo $con ? 'connected' : 'not connected';exit;
}
// Check connection
?>
