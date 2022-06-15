<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Overzicht Accommodatie</h1>
        <div class="table_content" id="admin_table">
            <table id="acco_tbl">
                <thead>
                    <tr>
                        <th>Soort</th>
                        <th>Kamers</th>
                        <th>Ligging</th>
                        <th>Faciliteit</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM accommodatie";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0) {
                        while($row = mysqli_fetch_array($query_run)){
                            ?>
                            <tr>
                                <td><?=$row['soort']; ?></td>
                                <td><?=$row['kamer']; ?></td>
                                <td><?=$row['ligging']; ?></td>
                                <td><?=$row['faciliteit']; ?></td>

                                <form action="acco.bewerk.php" method="POST">
                                    <td><input type="hidden" name="acco_hidden" value="<?=$row['idAcco'];?>"></td>
                                    <td><button name="update_acco">Update</button></td>
                        
                                </form>

                                <form action="../INCLUDES/admin.inc.php" method="POST">
                                    <td><a href="a_overview.admin.php"><button name="delete_acco">Verwijder</button></a></td>
                                    <td><input name="hidden_v_acco" type="hidden" value="<?=$row['idAcco']?>"></td>

                                </form>      
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="3">No Record Found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <section id="overview_btns">
            <div class="overview_btn" id="overview_bstm">
                <a href="b_overview.admin.php"><button type="">Overzicht Bestemming</button></a>
            </div>

            <div class="overview_btn" id="overview_fac">
                <a href="f_overview.admin.php"><button type="">Overzicht Faciliteit</button></a>
            </div>
            
            <div class="overview_btn" id="overview_reizen">
                <a href="r_overview.admin.php"><button type="">Overzicht Reizen</button></a>
            </div>

            <div class="overview_btn" id="btn_back">
                <a href="accommodatie.admin.php"><button type="">Toevoegen</button></a>
            </div>
        </section>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>






