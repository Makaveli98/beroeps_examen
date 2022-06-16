<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Overzicht Boekingen</h1>
        <div id="table_content_a">
            <table>
                <thead>
                    <tr>
                        <th>Boeking</th>
                        <th>User</th>
                        <th>Reis</th>
                        <th>Bestemming</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_b = "SELECT * FROM boeking";
                    $query_run_b = mysqli_query($conn, $query_b);

                    if(mysqli_num_rows($query_run_b) > 0) {
                        while($row_b = mysqli_fetch_array($query_run_b)){
                            ?>
                            <tr>
                                <td><?=$row_b['idBoeking'];?>BoekingsID</td>
                                <td><?=$row_b['userID'];?>UserID</td>
                                <td><?=$row_b['reisID'];?>ReisID</td>
                                <td><?=$row_b['bstmID'];?>BestemmingID</td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td>No Record Found</td>
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






