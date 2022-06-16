<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Overzicht Reizen</h1>
        <div class="table_content" id="admin_table">
            <table id="reis_tbl">
                <thead>
                    <tr>
                        <th>Plaats</th>
                        <th>Periode</th>
                        <th>Type</th>
                        <th>Vertrek</th>
                        <th>Check-in-balie</th>
                        <th>Vertrek Datum</th>
                        <th>Reis Nummer</th>
                        <th>Prijs</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM reis";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0) {
                        while($row = mysqli_fetch_array($query_run)){
                            ?>
                            <tr>
                                <td><?=$row['bestemming']; ?></td>
                                <td><?=$row['periode']; ?></td>
                                <td><?=$row['reis_type']; ?></td>
                                <td><?=$row['departure']; ?></td>   
                                <td><?=$row['check_in']; ?></td>   
                                <td><?=$row['vertrek_date']; ?></td>   
                                <td><?=$row['reis_nr']; ?></td>
                                <td><?=$row['prijs']; ?></td>
                                <form action="reis.bewerk.php" method="POST">
                                    <td><button name="update_reis">Update</button></td>
                                    <td><input type="hidden" name="reis_hidden" value="<?=$row['idReis'];?>"></td>
                                </form>

                                <form action="../INCLUDES/admin.inc.php" method="POST">
                                    <td><input name="hidden_v_reis" type="hidden" value="<?=$row['idReis']?>"></td>
                                    <td><a href="r_overview.admin.php"><button name="delete_reis">Verwijder</button></a></td>
                                </form>   
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td>No Record Found</td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
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

            <div class="overview_btn" id="overview_acco">
                <a href="a_overview.admin.php"><button type="">Overzicht Accommodatie</button></a>
            </div>

            <div class="overview_btn" id="overview_fac">
                <a href="f_overview.admin.php"><button type="">Overzicht Faciliteit</button></a>
            </div>

            <div class="overview_btn" id="btn_back">
                <a href="reizen.admin.php"><button type="">Toevoegen</button></a>
            </div>
        </section>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

