<?php 
require '../PHP/header.php';
?>

<div id="container_a">
    <?php include 'navbar.admin.php';?>

    <main id="main_a">
        <h1>Reis Updaten</h1>
        <div id="input_content">   
        <?php
        $get_idReis = mysqli_real_escape_string($conn, $_POST['reis_hidden']);
        $sql_update = mysqli_query($conn, "SELECT * FROM reis WHERE idReis = $get_idReis");
        if(mysqli_num_rows($sql_update) > 0) 
        {
            while($update = mysqli_fetch_array($sql_update)) 
            {
                ?>
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
                        <input type="text" name="periode" placeholder="Periode..." value="<?=$update['periode'];?>">
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
                        <input type="number" name="check_in" min="1" max="24" value="<?=$update['periode'];?>">
                    </div>

                    <!-- input field voor vertrek datum -->
                    <div>
                        <label for="">Vertrek Datum</label><br>
                        <input type="datetime-local" name="vertrek_date" value="<?=$update['vertrek_date'];?>">
                    </div>

                    <!-- input field voor reisnummer -->
                    <div>
                        <label for="">Reisnummer</label><br>
                        <input type="text" name="reis_nummer" placeholder="Reis Nummer..." value="<?=$update['reis_nr'];?>">
                    </div>

                    <!-- input field voor prijs -->
                    <div>
                        <label for="">Prijs</label><br>
                        <input type="text" name="prijs" placeholder="Prijs..." value="<?=$update['prijs'];?>" >
                    </div>

                    <input type="text" name="id_reis" value="<?=$update['idReis'];?>">
                    <a href="bestemming.admin.php"><button class="submit_btn" id="" type="submit">Terug</button></a>
                    <button class="submit_btn" id="btn_reis" type="submit" name="reis_update">Update</button>

                    </form>
                <?php
            }
        }
        ?>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

