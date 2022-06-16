<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    
    <main id="main_a">
        <h1>Accommodatie Invoegen</h1>
        <div id="input_content">
            <form id="input_acco" class="input" action="../INCLUDES/admin.inc.php" method="POST" enctype="multipart/form-data">
        
                <!-- input field voor de soort accommodatie -->
                <div>
                    <label for="soort">Accommodatie</label>
                    <input type="text" name="soort" placeholder="Accomodatie...">
                </div>

                

                <!-- input field voor de aantal kamers -->
                <div>
                    <label for="kamers">Aantal Kamers</label>
                    <input type="number" name="kamer" min="1" max="24">
                </div>
                

                <!-- input field voor de ligging -->
                <div>
                    <label for="ligging">Ligging</label>
                    <input type="text" name="ligging" placeholder="ligging...">
                </div>


                <div>
                    <label for="">Bestemming</label><br>
                    <select name="bestemming">
                            <option value="">--BESTEMMING--</option>
                        <?php
                        $sql_b = mysqli_query($conn, "SELECT * FROM bestemming");
                        while($data_b = mysqli_fetch_array($sql_b)) {
                            ?>
                                <option value="<?= $data_b['idBestemming']; ?>"><?= $data_b['plaats']
                                , " --- " , $data_b['idBestemming'], "  ";?>ID</option>
                            <?php
                        }   
                        ?>
                    </select>
                </div>

                <!-- input field voor de foto -->
                <div>
                    <label for="img">Foto</label>
                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" class="">
                </div>
                

                <!-- input field voor de checkboxen : faciliteit -->
                <div id="checkbox_container">
                    <label for="">Faciliteit</label>
                    <section class="checkbox_wrapper">
                        <?php
                        $query_a = mysqli_query($conn, "SELECT * FROM faciliteit");
                        if(mysqli_num_rows($query_a) > 0) {
                            foreach($query_a as $a_data) {
                                ?>
                                <section id="checkbox_div">
                                    <input class="checkbox" type="checkbox" name="checkbox_fac[]" id="checkbox" value="<?=$a_data['naam_fac'];?>">
                                    <p id="checkbox_text"><?=$a_data['naam_fac'];?></p>
                                </input>
                                </section>
                                <?php
                            }   
                        } else 
                        {
                            echo "LEEG";
                        }
                        ?>
                    </section>
                </div>

                <!-- submit button -->
                <div class="submit_btn" id="acco_btn">
                    <button type="submit" name="submit_accommodatie">Toevoegen</button>
                </div>
            </form>
        </div>


        <!-- Overzicht -->
        <div class="table_content" id="admin_table">
        <h1>Overzicht Accommodatie</h1>
            <table id="acco_tbl">
                <thead>
                    <tr>
                        <th>Bestemming ID</th>
                        <th>Bestemming</th>
                        <th>Soort</th>
                        <th>Kamers</th>
                        <th>Ligging</th>
                        <th>Faciliteit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM accommodatie INNER JOIN bestemming ON accommodatie.bstmID = bestemming.idBestemming";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0) {
                        while($row = mysqli_fetch_array($query_run)){
                            ?>
                            <tr>
                                <td><?=$row['idBestemming']; ?></td>
                                <td><?=$row['plaats']; ?></td>
                                <td><?=$row['soort']; ?></td>
                                <td><?=$row['kamer']; ?></td>
                                <td><?=$row['ligging']; ?></td>
                                <td><?=$row['faciliteit']; ?></td>

                                <form action="acco.bewerk.php" method="POST">
                                    <td><input type="hidden" name="acco_hidden" value="<?=$row['idAcco'];?>"></td>
                                    <td><button name="update_acco">Update</button></td>
                        
                                </form>

                                <form action="../INCLUDES/admin.inc.php" method="POST">
                                    <td><a href="a_overview.admin.php"><button name="delete_acco">Verwijder</button></a></td>
                                    <td><input name="hidden_v_acco" type="hidden" value="<?=$row['idAcco']?>"></td>

                                </form>      
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

        <div class="overview" id="overview_btns">
            <div class="overview_btn" id="overview_acco">
                <a href="acco.bewerk.php"><button type="">Update</button></a>
            </div>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>





    