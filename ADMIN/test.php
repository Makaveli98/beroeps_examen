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
                                        $get_bstmID = mysqli_real_escape_string($conn, $_GET['bstmID']);
                                        $sql_b = mysqli_query($conn, "SELECT * FROM bestemming");
                                        foreach($sql_b as $data_b) {
                                            ?>
                                                <option value="<?=$data_b['idBestemming'];?>"
                                                    <?php
                                                    if($get_bstmID == $data_b['idBestemming'])
                                                    {
                                                        echo "SELECTED";
                                                    }
                                                    ?>
                                                
                                                ><?= $data_b['plaats'], " --- ", $data_b['idBestemming'], "  ";?>ID</option>
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
                                        $checked_arr = array();
                                        $fetch_results = mysqli_query($conn, "SELECT * FROM faciliteit");
                                        if(mysqli_num_rows($fetch_results) > 0) 
                                        {
                                            while($result = mysqli_fetch_assoc($fetch_results)) 
                                            {   
                                                // $checked_arr = explode(", ", $_POST['checkbox']);
                                                $checked_arr = explode(", ", $_POST['checkbox']);
                                                $checbox_arr = array($result['naam_fac']);

                                                foreach($checbox_arr as $arr_data)
                                                {
                                                    // $checked = "";
                                                    ?>
                                                    <section id="checkbox_div">
                                                        <input class="checkbox" type="checkbox" name="fac_checkbox[]" 
                                                            id="checkbox" value="<?=$arr_data;?>"
                                                            <?php
                                                                if(in_array($arr_data, $checked_arr)) 
                                                                {
                                                                    // $checked = "checked";
                                                                    echo "checked";
                                                                }
                                                            ?>
                                                            >
                                                            <p id="checkbox_text"><?=$arr_data;?></p>
                                                        </input>
                                                    </section>
                                                    <?php
                                                }
                                              
                                            }
                                            exit(0);                               

                                        } else 
                                        {
                                            echo "No Records Found";
                                        } 
                                    ?>
                                    </section>
                                </div>

                           
                            <?php
                        }
                    }
                ?>
                <input type="text" name="id_acco" value="<?=$update['idAcco'];?>">
                <button class="submit_btn" id="btn_acco" type="submit" name="acco_update">Update</button>
            </form>
            <a href="accommodatie.admin.php"><button class="submit_btn" id="btn_acco_terug" type="">Terug</button></a>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>






