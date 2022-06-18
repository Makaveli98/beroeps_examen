<?php 
require '../PHP/header.php';
?>

<div id="container_a">
    <?php include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Accommodatie Updaten</h1>
        <div id="input_content">
            <form id="input_acco" class="input" action="../INCLUDES/admin.inc.php" method="POST" enctype="multipart/form-data">
                <?php
                    $get_idAcco = mysqli_real_escape_string($conn, $_POST['idAcco']);
                    $sql_update = mysqli_query($conn, "SELECT * FROM accommodatie WHERE idAcco = $get_idAcco");
                    if(mysqli_num_rows($sql_update) > 0) {
                        while($update = mysqli_fetch_assoc($sql_update)) 
                        {
                            ?>
                               <!-- input field voor de soort accommodatie -->
                                <div>
                                    <label for="soort">Accommodatie</label>
                                    <input type="text" name="soort" placeholder="Accomodatie..." value="<?=$update['soort'];?>">
                                </div>

                                <!-- input field voor de aantal kamers -->
                                <div>
                                    <label for="kamers">Aantal Kamers</label>
                                    <input type="number" name="kamer" min="1" max="24" value="<?=$update['kamer'];?>">
                                </div>

                                <!-- input field voor de ligging -->
                                <div>
                                    <label for="ligging">Ligging</label>
                                    <input type="text" name="ligging" placeholder="ligging..." value="<?=$update['ligging'];?>">
                                </div>

                                <!-- input field voor de bestemming -->
                                <div>
                                    <label for="">Bestemming</label><br>
                                    <select name="bestemming">
                                            <option value="">--BESTEMMING--</option>
                                        <?php
                                        $bstm_id = mysqli_real_escape_string($conn, $_POST['bstmID']);
                                        $sql = mysqli_query($conn, "SELECT * FROM bestemming");
                                        foreach($sql as $data) {
                                            ?>
                                                <option value="<?=$data['idBestemming'];?>"
                                                    <?php
                                                    if($bstm_id == $data['idBestemming'])
                                                    {
                                                        echo "SELECTED";
                                                    }
                                                    ?>
                                                
                                                ><?= $data['plaats'], " --- ", $data['idBestemming'], "  ";?>ID</option>
                                            <?php
                                        }    
                                        ?>
                                    </select>
                                </div>

                                <!-- input field voor de foto -->
                                <div>
                                    <label for="img">Foto</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" class="" value="<?=$update['picture'];?>">
                                </div>

                                <!-- input field voor de checkboxes -->
                                <div id="checkbox_container">
                                    <label for="">Faciliteit</label>
                                    <section class="checkbox_wrapper">
                                        <?php
                                            // print_r($selected);
                                            $checked_arr = array();
                                            $fetch_results = mysqli_query($conn, "SELECT * FROM faciliteit");
                                            if(mysqli_num_rows($fetch_results) > 0)
                                            {
                                                while($result = mysqli_fetch_assoc($fetch_results)) 
                                                {
                                                    $checked_arr = explode(", ", $_POST['checkbox']);
                                                    $checbox_arr = array($result['naam_fac']);

                                                    foreach($checbox_arr as $arr_data) 
                                                    {
                                                        ?>
                                                        <section id="checkbox_div">
                                                                <input class="checkbox" type="checkbox" name="fac_checkbox[]" id="checkbox" 
                                                                    value="<?=$result['naam_fac'];?>"
                                                                    <?php
                                                                        if(in_array($arr_data, $checked_arr)) {
                                                                           echo "checked";
                                                                        }
                                                                    ?>         
                                                                    >
                                                                    <p id="checkbox_text"><?=$result['naam_fac'];?></p>
                                                                </input>
                                                            </section>
                                                        <?php
                                                    }
                                                  
                                                }                              
                                            } else {
                                                echo "No Records Foun";
                                            }
                                        ?>
                                    </section>
                                </div>

                                <input type="text" name="id_acco" value="<?=$update['idAcco'];?>">
                                <button class="submit_btn" id="btn_acco" type="submit" name="acco_update">Update</button>
                            <?php
                        }
                    }
                ?>
            </form>
            <a href="accommodatie.admin.php"><button class="submit_btn" id="btn_acco_terug" type="">Terug</button></a>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>






