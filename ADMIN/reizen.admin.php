<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>

    <main id="main_a">
        <h1>Reis Invoegen</h1>
        <div class="input_content">
            <form class="input" action="../INCLUDES/admin.inc.php" method="POST">

                <!-- select field voor bestemmingen -->
                <!-- pakt dus de plaats vanuit de table: bestemmingen en zet het in een drop down list -->
                <div>
                    <label for="">Bestemming</label><br>
                    <select name="bestemming">
                            <option value="">--BESTEMMING--</option>
                        <?php
                        $query_b = mysqli_query($conn, "SELECT * FROM bestemming");
                        while($data_b = mysqli_fetch_array($query_b)) {
                            ?>
                                <option value="<?= $data_b['idBestemming']; ?>"><?= $data_b['plaats']; ?></option>
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

                        <option value="vliegtuig">Hal 1</option>
                        <option value="vliegtuig">Hal 2</option>
                        <option value="vliegtuig">Hal 3</option>

                        <option value="bus">Platform 1</option>
                        <option value="bus">Platform 2</option>
                        <option value="bus">Platform 3</option>

                        <option value="auto">Platform 4</option>
                        <option value="auto">Platform 5</option>
                        <option value="auto">Platform 6</option>
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
        
        <div class="overview" id="ov_btn">
            <a href="r_overview.admin.php"><button type="">Overzicht</button></a>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>
