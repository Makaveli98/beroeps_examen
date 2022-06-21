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
        <h1>Reis Invoegen</h1>
        <div id="input_content">
            <form id="input_reis" class="input" action="../INCLUDES/admin.inc.php" method="POST">

                <!-- select field voor bestemmingen -->
                <div>
                    <label for="">Bestemming</label><br>
                    <select name="bestemming">
                            <option value="">--BESTEMMING--</option>
                        <?php
                        $query_b = mysqli_query($conn, "SELECT * FROM bestemming");
                        while($data_b = mysqli_fetch_assoc($query_b)) {
                            ?>
                                <option value="<?= $data_b['idBestemming']; ?>"><?= $data_b['plaats'], " --- ", $data_b['idBestemming'], "  ";?>ID</option>
                            <?php
                        }   
                        ?>
                    </select>
                </div>

                <!-- input field voor periode -->
                <div>
                    <label for="">Periode</label><br>
                    <input type="text" name="periode" placeholder="Periode...">
                </div>
                
                <!-- select field voor reis type -->
                <div>
                    <label for="">Reis Type</label><br>
                    <select name="reis_type">
                        <option value="">--SELECT--</option>
                        <option value="Vliegtuig">Vliegtuig</option>
                        <option value="Bus">Bus</option>
                        <option value="Auto">Auto</option>
                        <option value="Trein">Trein</option>
                        <option value="Boot">Boot</option>
                    </select>
                </div>
                
                <!-- select field voor departure -->
                <div>
                    <label for="">Departure</label><br>

                    <select name="vertrek">
                        <option value="">--DEPARTURE--</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM departures");
                        while($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?=$data['idDeparture'];?>"><?=$data['departure'];?></option>
                            <?php
                        }   
                        ?>
                    </select>
                </div>
            
                <!-- input field voor check-in -->
                <div>
                    <label for="">Check-in-balie</label><br>
                    <input type="number" name="check_in" min="1" max="24">
                </div>

                <!-- input field voor vertrek datum -->
                <div>
                    <label for="">Vertrek Datum</label><br>
                    <input type="datetime-local" name="vertrek_date">
                </div>
                
                <!-- input field voor reisnummer -->
                <div>
                    <label for="">Reisnummer</label><br>
                    <input type="text" name="reis_nummer" placeholder="Reis Nummer...">
                </div>

                <!-- input field voor prijs -->
                <div>
                    <label for="">Prijs</label><br>
                    <input type="text" name="prijs" placeholder="Prijs...">
                </div>
                <button class="submit_btn" id="btn_reis" type="submit" name="reis_submit">Toevoegen</button>
            </form>
        </div>


        
        <!-- Overzicht -->
        <div class="table_content" id="admin_table">
            <h1 id="reis_title">Overzicht Reizen</h1>
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
                        <th>Update</th>
                        <th></th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM reis INNER JOIN departures ON reis.depID = departures.idDeparture 
                    INNER JOIN bestemming on reis.bestemmingID = bestemming.idBestemming";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0) {
                        while($row = mysqli_fetch_array($query_run)){
                            ?>
                            <tr>
                                <td><?=$row['plaats']; ?></td>
                                <td><?=$row['periode']; ?></td>
                                <td><?=$row['naam_type']; ?></td>
                                <td><?=$row['departure']; ?></td>   
                                <td><?=$row['check_in']; ?></td>   
                                <td><?=$row['vertrek_date']; ?></td>   
                                <td><?=$row['reis_nr']; ?></td>
                                <td><?=$row['prijs']; ?></td>
                                <td>
                                    <form action="reis.bewerk.php" method="POST">
                                        <input type="hidden" value="<?=$row['idReis']?>" name="id_reis"></input>
                                        <input type="hidden" value="<?=$row['idBestemming']?>" name="id_bstm"></input>
                                        <input type="hidden" value="<?=$row['naam_type']?>" name="type"></input>
                                        <input type="hidden" value="<?=$row['idDeparture']?>" name="departure"></input>
                                        <button name="update_reis">Update</button></a>
                                    </form>
                                </td>

                                <form action="../INCLUDES/admin.inc.php" method="POST">
                                    <td><input name="hidden_v_reis" type="hidden" value="<?=$row['idReis']?>"></td>
                                    <td><a href="reizen.admin.php"><button name="delete_reis">Verwijder</button></a></td>
                                </form>   
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="11">No Record Found</td>
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

