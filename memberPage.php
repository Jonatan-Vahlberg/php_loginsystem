<?php
    include_once './includes/header.php';
    include_once './includes/dbh.php';
?>
    <section class="main_container">
        <div class="main_wrapper">
            <div class="member_area">

                <?php
                    if(isset($_SESSION['u_id'])){
                        echo "<h3 class='memhead'>",$_SESSION['u_first']," ",$_SESSION['u_last'],"'s Page</h3>";
                        echo "<p class='center'>On this page you can change acount details and in the future we hope to add a messageboard</p>";
                        echo "<p class ='center'>More Info Coming Soon!</p>";
                        echo "<div class='pictureframe'><p></p></div>";
                        echo "<div class='memberinfo'>";
                        echo "<p>Username: ",$_SESSION['u_name'],"</p>";
                        echo "<p>Email: ",$_SESSION['u_mail'],"</p><br>";
                        echo "<h4>New Password</h4>";
                        echo "<form action='./includes/passwordChange.php' method='POST'>
                                <input type='password' name='chpass1' placeholder='Current Password'>";
                        echo "<input type='password'name='chpass2' placeholder='New Password'>";
                        echo "<button type='submit' name='submit'>Change Password</button>";
                        echo "</form></div>";

                    }
                ?>
            </div>
        </div>
    </section>
    
    <?php include_once './includes/footer.php';?>

</body>
</html>