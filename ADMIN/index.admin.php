<?php 
require '../PHP/header.php';
if($_SESSION['auth_role'] == '0' || $_SESSION['auth_role'] == NULL)
{   
    header('Location: ../PHP/index.php?YouAreNotTheAdmin');
    exit(0);
}
?>

<div id="container_a">
    <?php include 'navbar.admin.php';?>
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
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id_user = $_SESSION['auth_user']['user_id'];
                    $query_b = "SELECT * FROM boeking INNER JOIN users ON boeking.userID = users.idUser
                    INNER JOIN reis ON boeking.reisID = reis.idReis";
                    $query_run_b = mysqli_query($conn, $query_b);

                    if(mysqli_num_rows($query_run_b) > 0) {
                        while($row_b = mysqli_fetch_array($query_run_b)){
                            ?>
                            <tr>
                                <td name="boeking_id" value="<?=$row_b['idBoeking'];?>"><?=$row_b['idBoeking'];?></td>
                                <td><?=$row_b['bestemming'];?></td>
                                <td><?=$row_b['periode'];?></td>
                                <td><?=$row_b['voornaam'];?></td>
                                <td><?=$row_b['email'];?></td>
                                <td><?=$row_b['telefoon_nr'];?></td>
                                <td>    
                                    <form action="../INCLUDES/admin.inc.php" method="POST">
                                        <input type="hidden" name="boeking_id" value="<?=$row_b['idBoeking'];?>">
                                        <td><a href="index.admin.php"><button name="delete_boeking">Verwijder</button></a></td>
                                    </form> 
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="7">No Record Found</td>
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






