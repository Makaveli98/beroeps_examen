<?php 
require '../PHP/header.php';
?>

<div id="container_a">
    <?php include 'navbar.admin.php';?>
 
    <main id="main_a">
        <h1>Departure Invoegen</h1>
        <div id="input_content">
            <form id="input_fac" class="input" action="../INCLUDES/admin.inc.php" method="POST">
                <div>
                    <label for="">Departure:</label>
                    <input type="text" name="dep" placeholder="Departure...">
                </div>
                <button class="submit_btn" id="btn_fac" type="submit" name="dep_submit">Toevoegen</button>
            </form>
        </div>


        <!-- Overzicht -->
        <h1>Overzicht Departures</h1>
        <div class="fac_container">
            <div class="fac_wrapper">
            <?php
            $query = "SELECT * FROM departures";
            $query_run = mysqli_query($conn, $query);

            if(mysqli_num_rows($query_run) > 0) {
                while($row = mysqli_fetch_array($query_run)){
                ?>
                <form action="../INCLUDES/admin.inc.php" method="POST">
                    <div class="name_fac"><h4><?=$row['departure'];?></h4>
                        <input type="hidden" name="departure" value="<?=$row['idDeparture'];?>">
                        <a href="f_overview_admin.php"><button class="fac_delete_btn" name="delete_dep">Delete</button></a>
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

