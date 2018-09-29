<?php

session_start();
include_once 'dbh.php';
$id = $_SESSION['u_id'];
$filename = "images/profile".$id.".*";
$fileinfo = glob($filename);
if(!unlink($fileinfo[0])){
    echo "there was a problem with yoy deletion";
    exit();
}
else{
    echo  "File Deleted";
    $sql = "UPDATE profileimg SET status= 1 WHERE userid='$id' ;";
    mysqli_query($conn,$sql);
    header: ("Location: ../memberPage.php?delete=success");
    exit();
}