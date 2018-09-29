<?php

    if(!isset($_POST['submit'])){
        header("Location: ../signup.php?signup=error");
        exit();
    }
    else{
        include_once './dbh.php';
        $first = mysqli_real_escape_string($conn, $_POST['u_f']);
        $last = mysqli_real_escape_string($conn, $_POST['u_l']);
        $name = mysqli_real_escape_string($conn, $_POST['u_n']);
        $pass = mysqli_real_escape_string($conn, $_POST['u_p']);
        $mail = mysqli_real_escape_string($conn, $_POST['u_e']);
        
        //ERROR Handlers
        if(empty($first) || empty($last) || empty($name) ||
         empty($pass) || empty($mail)){
            header("Location: ../signup.php?signup=empty");
            exit();
         }
         else{
             //REGEX 
             //First And Last
            if(!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
                header("Location: ../signup.php?signup=invchar");
                exit();
             }
             else{
                //check for username
                $sql = "SELECT * FROM users WHERE u_n='$name'";
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0){
                    header("Location: ../signup.php?signup=usertaken");
                    exit(); 
                }
                else{
                    if(!(preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,16}$/",$name))){
                        header("Location: ../signup.php?signup=invuser");
                        exit();
                    }
                    else{
                        if(!(preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,16}$/",$pass))){
                            header("Location: ../signup.php?signup=invpass");
                            exit();
                        }                    
                        else{
                            //hashing the password
                            $hashedpass = password_hash($pass,PASSWORD_DEFAULT);
                            //check Email
                            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                                header("Location: ../signup.php?signup=invmail");
                                exit();
                            }
                            else{
                                $sqli = "INSERT INTO users (u_f, u_l, u_n, u_p, u_e) 
                                VALUES('$first','$last','$name','$hashedpass','$mail');";
                                $resulti = mysqli_query($conn,$sqli);
                                $sql = "SELECT * FROM users WHERE u_n = '$name' AND u_f = '$first'";
                                $result = mysqli_query($conn,$result);
                                if(mysqli_num_rows < 1){
                                    header("Location: ../signup.php?signup=Error");
                                exit();
                                }
                                else{
                                    while($row = mysqli_fetxh_assoc($result));
                                    $userid = $row['id'];
                                    $sqla = "INSERT INTO profileimg (userid,status) 
                                    VALUES('$userid',1)";
                                    mysqli_query($conn,$sqla);
                                    header("Location: ../signup.php?signup=success");
                                    xit();
                                }
                                
                            }
                        }
                    }       
                }
            }
        }
    }