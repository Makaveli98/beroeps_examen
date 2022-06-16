<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>

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
                        while($data_b = mysqli_fetch_array($query_b)) {
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
                        <option value="">--TYPE--</option>

                        <option value="auto">Auto</option>
                        <option value="bus">Bus</option>
                        <option value="vliegtuig">Vliegtuig</option>
                    </select>
                </div>
                
                <!-- select field voor departure -->
                <div>
                    <label for="">Departure</label><br>
                    <select name="vertrek">
                        <option value="">--DEPARTURE--</option>

                        <option>Hal 1</option>
                        <option>Hal 2</option>
                        <option>Hal 3</option>

                        <option>Platform 1</option>
                        <option>Platform 2</option>
                        <option>Platform 3</option>

                        <option>Platform 4</option>
                        <option>Platform 5</option>
                        <option>Platform 6</option>
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

                <!-- submit button -->
                <div class="submit_btn" id="reis_btn">
                    <button type="submit" name="reis_submit">Add</button>
                </div>
            </form>
        </div>


        
        <!-- Overzicht -->
        <div class="table_content" id="admin_table">
            <h1>Overzicht Reizen</h1>
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
                            <td colspan="8">No Record Found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- to update btn -->
        <div class="overview" id="overview_btns">
            <div class="overview_btn" id="overview_reis">
                <a href="reis.bewerk.php"><button type="">Update</button></a>
            </div>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

