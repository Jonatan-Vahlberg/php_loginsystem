<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>INDEX</title>
</head>
<body>
    <header>
        <nav>
            <div class="main_wrapper">
                <ul>
                    <li id="homeLink" ><a href="index.php">Home</a></li>
                   <?php 
                        if(isset($_SESSION['u_id'])){
                            echo '<li><a href="memberPage.php">Member Area</a></li>';
                        }
                    ?>
                </ul>
            
                <div class="nav_login">
                    <?php
                        if(isset($_SESSION['u_id'])){
                            echo 
                            '<form action ="./includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';
                        }
                        else{
                            echo 
                            '<form action="./includes/login.inc.php" method="POST">
                            <input type="text" name="u_n" placeholder="Username/e-mail">
                            <input type="password" name="u_p" placeholder="password">
                            <button type="submit" name="submit">Log In</button>
                            </form> 
                            <a href="signup.php">Sign up</a>';
                        }
                    ?>
                    
                    
                    
                </div>
            </div>
        </nav>
    </header>