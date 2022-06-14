<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>

    <main id="main_a">
        <h1>Bestemming Updaten</h1>
        <div id="input_content">
            <?php 
            if(isset($_POST['update_bstm']))
            {
                $get_bstm_id = $_POST['bstm_hidden'];
                ?>
                <form class="input" action="../INCLUDES/admin.inc.php" method="POST">
                    <input type="hidden" name="bstm_h" value="<?=$get_bstm_id?>"> 
                    
                    <!-- input field voor de plaats van de bestemming -->
                    <div>
                        <label for="">Plaats:</label><br>
                        <input type="text" name="plaats" placeholder="Plaats...">
                    </div>

                    <!-- input field voor het land van de bestemming -->
                    <div>
                        <label for="">Land:</label><br>
                        <input type="text" name="land" placeholder="Land...">
                    </div>

                    <!-- input field voor de provincie van de bestemming -->
                    <div>
                        <label for="">Provincie:</label><br>
                        <input type="text" name="provincie" placeholder="provincie...">
                    </div>

                    <!-- input field voor de accommodatie -->
                    <div>
                        <label for="">Accommodatie</label><br>
                        <select class="dropdown" name="accomodatie">
                            <option>----- ACCOMMODATIE -----</option>
                            <?php 
                            $query_a = mysqli_query($conn, "SELECT * FROM `accommodatie`");
                            while ($data_a = mysqli_fetch_array($query_a)){
                                ?>  
                                    <option value="<?= $data_a['idAcco']; ?>"><?= $data_a['soort']; ?></option>
                                <?php
                            }
                                ?>
                        </select>
                    </div>

                    <section class="dummy_div"></section>

                    <!-- submit button -->
                    <div class="submit_btn" id="bstm_btn">
                        <button type="submit" name="bstm_update">Update</button>
                    </div> 
                </form>        
                <?php
            }
            ?>
        </div>

        <div class="overview" id="ov_btn">
            <a href="b_overview.admin.php"><button type="">Overzicht</button></a>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

