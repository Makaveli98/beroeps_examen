<?php 
require '../PHP/header.php';
?>

<div id="container_a">
    <?php include 'navbar.admin.php';?>

    <main id="main_a">
        <h1>Reis Updaten</h1>
        <div id="input_content">   
        <?php
        $get_type = mysqli_real_escape_string($conn, $_POST['type']);
        $get_reis_id = mysqli_real_escape_string($conn, $_POST['id_reis']);
        $sql_reis = mysqli_query($conn, "SELECT * FROM reis WHERE idReis = $get_reis_id");
        if(mysqli_num_rows($sql_reis) > 0) 
        {
            while($sql_results = mysqli_fetch_array($sql_reis)) 
            {
                ?>
                <form id="input_reis" class="input" action="../INCLUDES/admin.inc.php" method="POST">

                    <!-- select field voor bestemmingen -->
                    <div>
                        <label for="">Bestemming</label><br>
                        <select name="bestemming">
                                <option value="">--BESTEMMING--</option>
                            <?php
                            $get_bstm_id = mysqli_real_escape_string($conn, $_POST['id_bstm']);
                            $sql_bstm = mysqli_query($conn, "SELECT * FROM bestemming");
                            foreach($sql_bstm as $data_bstm) {
                                ?>
                                    <option value="<?=$data_bstm['idBestemming'];?>"
                                        <?php
                                        if($get_bstm_id == $data_bstm['idBestemming'])
                                        {
                                            echo "selected";
                                        }
                                        ?>
                                    
                                    ><?= $data_bstm['plaats'], " --- ", $data_bstm['idBestemming'], "  ";?>ID</option>
                                <?php
                            }   
                            ?>
                        </select>
                    </div>

                    <!-- input field voor periode -->
                    <div>
                        <label for="">Periode</label><br>
                        <input type="text" name="periode" placeholder="Periode..." value="<?=$sql_results['periode'];?>">
                    </div>

                    <!-- select field voor reis type -->
                    <div>
                        <label for="">Reis Type</label><br>
                        <select name="reis_type">
                            <option value="">--TYPE--</option>
                            <option value="Vliegtuig"
                            <?php 
                            if($get_type == 'Vliegtuig')
                            {
                                echo "selected";
                            }
                            ?>
                            >Vliegtuig</option>

                            <option value="Bus"
                            <?php 
                            if($get_type == 'Bus')
                            {
                                echo "selected";
                            }
                            ?>
                            >Bus</option>

                            <option value="Auto"
                            <?php 
                            if($get_type == 'Auto')
                            {
                                echo "selected";
                            }
                            ?>
                            >Auto</option>

                            <option value="Trein"
                            <?php 
                            if($get_type == 'Trein')
                            {
                                echo "selected";
                            }
                            ?>
                            >Trein</option>

                            <option value="Boot"
                            <?php 
                            if($get_type == 'Boot')
                            {
                                echo "selected";
                            }
                            ?>
                            >Boot</option>
                        </select>
                    </div>

                    <!-- select field voor departure -->
                    <div>
                        <label for="">Departure</label><br>
                        <select name="vertrek">
                                <option value="">--DEPARTURE--</option>
                            <?php
                            $get_dep_id = mysqli_real_escape_string($conn, $_POST['departure']);
                            $sql_dep = mysqli_query($conn, "SELECT * FROM departures");
                            foreach($sql_dep as $data_dep) 
                            {
                                ?>
                                    <option value="<?=$data_dep['idDeparture'];?>"
                                        <?php
                                        if($get_dep_id == $data_dep['idDeparture'])
                                        {
                                            echo "selected";
                                        }
                                        ?>
                                    
                                    ><?=$data_dep['departure'];?></option>
                                <?php
                            }   
                            ?>
                        </select>
                    </div>
                   

                    <!-- input field voor check-in -->
                    <div>
                        <label for="">Check-in-balie</label><br>
                        <input type="number" name="check_in" min="1" max="24" value="<?=$sql_results['check_in'];?>">
                    </div>

                    <!-- input field voor vertrek datum -->
                    <div>
                        <label for="">Vertrek Datum</label><br>
                        <input type="datetime" name="vertrek_date" value="<?=$sql_results['vertrek_date'];?>">
                    </div>

                    <!-- input field voor reisnummer -->
                    <div>
                        <label for="">Reisnummer</label><br>
                        <input type="text" name="reis_nummer" placeholder="Reis Nummer..." value="<?=$sql_results['reis_nr'];?>">
                    </div>

                    <!-- input field voor prijs -->
                    <div>
                        <label for="">Prijs</label><br>
                        <input type="text" name="prijs" placeholder="Prijs..." value="<?=$sql_results['prijs'];?>" >
                    </div>

                    <input type="text" name="id_reis" value="<?=$sql_results['idReis'];?>">
                    <button class="submit_btn" id="btn_reis_update" type="submit" name="reis_update">Update</button>

                    </form>
                <?php
            }
        }
        ?>
        </div>
        <a href="reizen.admin.php"><button class="submit_btn" id="btn_reis_terug" type="submit">Terug</button></a>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

