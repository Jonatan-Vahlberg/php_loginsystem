<?php
session_start();
include_once "./dbh.php";
$id = $_SESSION['u_id'];
ob_start();
if(!isset($_POST['submit'])){

}
else{

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExo = explode('.',$fileName);
    $fileExt = strtolower(end($fileExo));
    $curentDir = getcwd();
    $uploadDir = "../images/";
    $uploadPath = $curentDir . $uploadDir . basename($fileName);

    $allowed = ['jpg','jpeg','png','gif'];
    if(!in_array($fileExt,$allowed)){
        echo "You can't upload this filetype Allowed:jpg,jpeg,png,gif";
        exit();
    }
    else{
        if(!$fileError === 0){
            echo "There was an error uploading you file";
            exit();
        }
        else{
            if($fileSize > 3000000){
                echo "Yo file to big for this page Max is: 3 Mb";
                exit();
            }
            else{
                
                // $realfilename = uniqid('',true).".".$fileActualExt;
                // $fileDest ="./".$realfilename;
                // $realfilename = uniqid('',true).".".$fileActualExt;
                    // $fileDest ="./".$realfilename;
                    $realname = "profile".$id.".". $fileExt;
                    $realpath = "images/".$realname;
                    $didUpload =  move_uploaded_file($fileTmpName,$realpath);
                    
                if(!$didUpload){
                    header("Location: ../memberPage.php?upload=error");    
                    echo "An error Has ocured";
                       
                }else{
                    $sql = "UPDATE profileimg SET status=0 WHERE userid='$id'";
                    $result = mysqli_query($conn,$sql);
                    header ("Location: ../memberPage.php?upload=success");
                    exit();
                }
            }
        }
    }
}

ob_end_flush();