<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Overzicht Bestemming</h1>
        <div class="table_content" id="admin_table">
            <table id="bstm_tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Plaats</th>
                        <th>Land</th>
                        <th>Provincie</th>
                        <th>Accommodatie</th>
                        <th>ID Acco</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM bestemming INNER JOIN accommodatie ON bestemming.idBestemming = accommodatie.bstmID");
                if(mysqli_num_rows($query) > 0) {
                    foreach($query as $row){
                        ?>
                        <tr>
                            <td><?=$row['idBestemming']; ?></td>
                            <td><?=$row['plaats']; ?></td>
                            <td><?=$row['land']; ?></td>
                            <td><?=$row['provincie']; ?></td>
                            <td><?=$row['soort']; ?></td>
                            <td><?=$row['idAcco']; ?></td>
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
                        <td>No Record Found</td>
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
            <div class="overview_btn" id="overview_acco">
                <a href="a_overview.admin.php"><button type="">Overzicht Accommodatie</button></a>
            </div>

            <div class="overview_btn" id="overview_fac">
                <a href="f_overview.admin.php"><button type="">Overzicht Faciliteit</button></a>
            </div>

            <div class="overview_btn" id="overview_reizen">
                <a href="r_overview.admin.php"><button type="">Overzicht Reizen</button></a>
            </div>

            <div class="overview_btn" id="btn_back">
                <a href="bestemming.admin.php"><button type="">Toevoegen</button></a>
            </div>
        </section>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

