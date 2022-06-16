<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>

    <main id="main_a">
        <h1>Bestemming Invoegen</h1>
        <div id="input_content">
            <form id="input_bstm" class="input" action="../INCLUDES/admin.inc.php" method="POST">

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

                <div id="checkbox_container">
                    <label for="">Accommodatie</label>
                    <section class="checkbox_wrapper">
                        <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM accommodatie");
                        if(mysqli_num_rows($sql) > 0)
                        {
                        foreach($sql as $sql_data)
                        {
                            ?>
                            <section id="checkbox_div">
                                <input class="checkbox" type="checkbox" name="checkbox_acco[]" value="<?=$sql_data['soort'];?>" >
                                <p id="checkbox_text"><?=$sql_data['soort'];?></p>
                            </section>
                            <?php
                        }
                        } else 
                        {
                            echo "LEEG";
                        }
                        ?>
                    </section>
                </div>



                <!-- submit button -->
                <div class="submit_btn" id="bstm_btn">
                    <button type="submit" name="bestemming_submit">Add</button>
                </div> 
            </form>
        </div>

        <div class="overview" id="overview_btns">
            <div class="overview_btn" id="overview_bstm">
                <a href="b_overview.admin.php"><button type="">Overzicht</button></a>
            </div>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

