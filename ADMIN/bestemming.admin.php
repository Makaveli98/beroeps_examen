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

                <!-- submit button -->
                <div class="submit_btn" id="bstm_btn">
                    <button type="submit" name="bestemming_submit">Add</button>
                </div> 
            </form>
        </div>



        <!-- Overzicht -->
        <div class="table_content" id="admin_table">
            <h1>Overzicht Bestemming</h1>
            <table id="bstm_tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Plaats</th>
                        <th>Land</th>
                        <th>Provincie</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM bestemming"); 
                // -- INNER JOIN accommodatie ON bestemming.idBestemming = accommodatie.bstmID");
                if(mysqli_num_rows($query) > 0) {
                    foreach($query as $row){
                        ?>
                        <tr>
                            <td><?=$row['idBestemming']; ?></td>
                            <td><?=$row['plaats']; ?></td>
                            <td><?=$row['land']; ?></td>
                            <td><?=$row['provincie']; ?></td>
            
                            <form action="bstm.bewerk.php" method="POST">
                                <td><button name="update_bstm">Update</button></td>
                                <td><input type="hidden" name="bstm_hidden" value="<?=$row['idBestemming'];?>"></td>
                            </form>

                            <form action="../INCLUDES/admin.inc.php" method="POST">
                                <td><input name="hidden_v_bstm" type="hidden" value="<?=$row['idBestemming']?>"></td>
                                <td><a href="b_overview.admin.php"><button name="delete_bstm">Verwijder</button></a></td>
                            </form>   
                        </tr>
                        <?php
                    }
                }
                else {
                    ?>
                    <tr>
                        <td colspan="4">No Record Found</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>  

        <div class="overview" id="overview_btns">
            <div class="overview_btn" id="overview_bstm">
                <a href="bstm.bewerk.php"><button type="">Update</button></a>
            </div>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

