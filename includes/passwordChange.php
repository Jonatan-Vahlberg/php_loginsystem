
<?php
    session_start();
    if(!isset($_POST['submit'])){
        header("Location: ../memberPage.php?change=error");
        exit();
    }
    else{
        include_once './dbh.php';
        $cPass = mysqli_real_escape_string($conn,$_POST['chpass1']);
        $nPass = mysqli_real_escape_string($conn,$_POST['chpass2']);
        if( empty($cPass) || empty($nPass)){
            header("Location: ../memberPage.php?change=empty");
            exit();
        }
        else{
            $name =$_SESSION["u_name"];
            $sql = "SELECT * FROM users WHERE u_n='$name'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck < 1){
                header("Location: ../memberPage.php?change=error");
            exit();
            }
            else{
                if($row = mysqli_fetch_assoc($result)){
                    $hashedPassCheck = password_verify($cPass,$row['u_p']);

                    if($hashedPassCheck == false){
                        header("Location: ../memberPage.php?change=error");
                        exit();
                    }
                    elseif($hashedPassCheck == true){
                        if(!(preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,16}$/",$nPass))){
                            header("Location: ../memberPage.php?change=syntax");
                            exit();
                        }
                        else{
                            //Hash password first
                            $nPassHash = password_hash($nPass,PASSWORD_DEFAULT);

                            $sqli = "UPDATE users SET u_p='$nPassHash'";
                            $resulti = mysqli_query($conn,$sqli);
                            header("Location: ../memberPage.php?change=success");
                            exit();

                        }
                    }
                }
            }
        }
    }