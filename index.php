
<?php
    include_once './includes/header.php';
    include_once './includes/dbh.php';
?>
    <section class="main_container">
        <div class="main_wrapper">
            <h2 id="head">WELCOME</h2>
            <?php
                if(isset($_SESSION['u_id'])){
                    echo "<h2>",$_SESSION['u_first']," ",$_SESSION['u_last'],"</h2>";
                }
            ?>
        </div>
    </section>
    
    <?php include_once './includes/footer.php';?>

</body>
</html>