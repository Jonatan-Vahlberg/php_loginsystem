<?php
    include_once './includes/header.php';
    include_once './includes/dbh.php';
?>
    <section class="main_container">
        <div class="main_wrapper">
            <h2>Signup</h2>
        
            <form class="signup_Form" action="./includes/signup.inc.php" method="POST">
                <input type="text" name="u_f" placeholder="First Name">
                <input type="text" name="u_l" placeholder="Last Name">
                <input type="text" name="u_n" placeholder="Username">
                <input type="password" name="u_p" placeholder="password">
                <input type="text" name="u_e" placeholder="Email">
                <button type="submit" name="submit">Log In</button>
            </form>
            
        </div>
    </section>
    
    <?php include_once './includes/footer.php';?>

</body>
</html>
