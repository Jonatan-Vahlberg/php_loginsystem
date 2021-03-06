<?php

    session_start();



    if(!isset($_POST['submit'])){
        header("Location: ../index.php?login=error");
        exit();
    }
    else{
        include './dbh.php';
        $name = mysqli_real_escape_string($conn, $_POST['u_n']);
        $pass = mysqli_real_escape_string($conn, $_POST['u_p']);

        //error handlers
        //check empty
        if(empty($name) || empty($pass)){
            
            header("Location: ../index.php?login=empty");
            exit();
         }
         else{
             //extra 'e' for email
            $sql = "SELECT * FROM users WHERE u_n='$name' OR u_e='$name'";
            
            
            $result = mysqli_query($conn,$sql);
            
            
            $resultCheck = mysqli_num_rows($result);
            

            if($resultCheck < 1){
                header("Location: ../index.php?login=error");
                exit();
            }
            else{
                
                if($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                   
                    //dehashing password
                    $hashedPassCheck = password_verify($pass,$row['u_p']);
                    if($hashedPassCheck == false){
                        header("Location: ../index.php?login=error");
                        exit();
                    }elseif($hashedPassCheck == true){
                        //log in the user Here
                        $_SESSION['u_id'] = $row['id'];
                        $_SESSION['u_first'] = $row['u_f'];
                        $_SESSION['u_last'] = $row['u_l'];
                        $_SESSION['u_name'] = $row['u_n'];
                        $_SESSION['u_mail'] = $row['u_e'];
                        $_SESSION['u_img'] = $row['u_pi'];
                        header("Location: ../index.php?login=success");
                        exit();
                    }
                }
            }
        }
    }