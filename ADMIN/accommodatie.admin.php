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
                                <option value="<?= $data_b['idBestemming']; ?>">
                                <?= $data_b['plaats'], " --- " , $data_b['idBestemming'], "  ";?> ID </option>
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
                            $sql_results = mysqli_query($conn, "SELECT * FROM faciliteit");
                            if(mysqli_num_rows($sql_results) > 0) {
                                foreach($sql_results as $sql_result) 
                                {
                                   ?>
                                        <section id="checkbox_div">
                                            <input class="checkbox" type="checkbox" name="fac_checkbox[]" 
                                                id="checkbox" value="<?=$sql_result['naam_fac'];?>">
                                                <p id="checkbox_text"><?=$sql_result['naam_fac'];?></p>
                                            </input>
                                        </section>
                                    <?php
                                }   
                            } else 
                            {
                                echo "No Records Found";
                            }
                        ?>
                    </section>
                </div>                
                <button class="submit_btn" id="btn_acco" type="submit" name="submit_accommodatie">Toevoegen</button>
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
                        <th>Update</th>
                        <th>Delete</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM accommodatie 
                    INNER JOIN bestemming ON accommodatie.bstmID = bestemming.idBestemming";
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
                                <td>
                                    <form action="acco.bewerk.php" method="POST">
                                        <input type="hidden" value="<?=$row['idAcco'];?>" name="idAcco">
                                        <input type="hidden" value="<?=$row['bstmID'];?>" name="bstmID">
                                        <input type="hidden" value="<?=$row['faciliteit'];?>" name="checkbox">
                                        <button>Updaten</button>
                                    </form>
                                </td>

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





    