<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
 
    <main id="main_a">
        <h1>Faciliteit Invoegen</h1>
        <div id="input_content">
            <form id="input_fac" class="input" action="../INCLUDES/admin.inc.php" method="POST">
                <div>
                    <label for="">Faciliteit:</label>
                    <input type="text" name="faciliteit" placeholder="Faciliteit...">
                </div>

                <div class="submit_btn" id="fac_btn">
                    <button type="submit" name="faciliteit_submit">Add</button>
                </div>
            </form>
        </div>


        <!-- Overzicht -->
        <h1>Overzicht Faciliteiten</h1>
        <div class="fac_container">
            <div class="fac_wrapper">
            <?php
            $query = "SELECT * FROM faciliteit";
            $query_run = mysqli_query($conn, $query);

            if(mysqli_num_rows($query_run) > 0) {
                while($row = mysqli_fetch_array($query_run)){
                ?>
                <form action="../INCLUDES/admin.inc.php" method="POST">
                    <div class="name_fac"><h4><?=$row['naam_fac'];?></h4>
                        <input type="hidden" name="fac_naam" value="<?=$row['idFac'];?>">
                        <a href="f_overview_admin.php"><button class="fac_delete_btn" name="delete_fac">Delete</button></a>
                    </div>
                </form>
                <?php
                }
            }
            else {
                echo "No Records Found";
            }
            ?>
            </div>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

