<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Overzicht Boekingen</h1>
        <div class="table_content" id="admin_table">
            <table id="boeking_tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bestemming</th>
                        <th>Periode</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Telefoonnummer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $query_b = "SELECT * FROM boeking INNER JOIN reis ON boeking.reisID = reis.idReis";
                    $query_run_b = mysqli_query($conn, $query_b);

                    if(mysqli_num_rows($query_run_b) > 0) {
                        while($row_b = mysqli_fetch_array($query_run_b)){
                            ?>
                            <tr>
                                <td><?=$row_b['idBoeking'];?></td>
                                <td><?=$row_b['bestemming'];?></td>
                                <td><?=$row_b['periode'];?></td>
                                <td><?=$_SESSION['auth_user']['user_name']?></td>
                                <td><?=$_SESSION['auth_user']['user_email']?></td>
                                <td><?=$_SESSION['auth_user']['user_tnr']?></td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="6">No Record Found</td>
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






