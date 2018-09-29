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
                    echo "<div class='profile'>";
                    echo " <div class='pictureframe'>";
                    
                    $un = $_SESSION['u_name']; 
                    $sql = "SELECT * FROM users WHERE u_n='$un'";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) < 1){
                        echo "error";
                    }
                    else{
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['id'];
                            $sqlimg = "SELECT * FROM profileimg WHERE userid='$id'";
                            $resultimg = mysqli_query($conn,$sqlimg);
                            while($rowimg = mysqli_fetch_assoc($resultimg)){
                                if($rowimg['status'] == 1){
                                    echo "<img id='profileImg' src='./includes/images/defult.jpg'>";
                                }else{
                                    $filename = "includes/images/profile".$id.".*";
                                    $fileinfo = glob($filename);
                                    echo"<img id='profileImg' src='".$fileinfo[0]."'>";
                                }
                                
                            }
                           
                        }
                    }
                       
                    echo "</div>
                            <div class='pictureArea'>  
                                <form id='picform' action='./includes/upload.php' method='POST' enctype='multipart/form-data'>
                                    <label id='firstla' for='file'>Choose File</label><input type='file' name='file' id='file' class='inputFile'><label for='file' placeholdr='Choose a file' >"."</label>
                                    <button type='submit' name='submit'>UPLOAD</button>
                                </form>
                            </div> 
                            <div class='pictureArea' id='pA2'>
                            <form id='picform2' action='./includes/delete.php' method='POST'>
                                <button type='submit' name='submit'>DELETE</button>
                            </form>
                            </div>";
                    echo "</div>";
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