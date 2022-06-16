<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Admin Dashboard</h1>
        <div class="table_content">
            <h2 class="title_boeking">Boekingen</h2>
            <table id="boeking_tbl">
                <thead>
                    <tr>
                        <th>Naam Klant</th>
                        <th>Bestemming</th>
                        <th>Reis Nummer</th>
                        <th>Periode</th>
                        <th>Prijs</th>
                        <!-- <th>Accommodatie</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM boeking INNER JOIN reis 
                    ON boeking.reisID = reis.idReis";
                    $sql_run = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($sql_run) > 0) {
                        while($f_data = mysqli_fetch_array($sql_run)){
                            ?>
                            <tr>
                                <td><?=$f_data['bestemming']; ?></td>
                                <td><?=$f_data['reis_nr']; ?></td>
                                <td><?=$f_data['periode']; ?></td>
                                <td><?=$f_data['prijs']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td>No Record Found</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>






