<?php
require '../PHP/header.php';

$get_reis_id = mysqli_real_escape_string($conn, $_POST['id_reis']);
$get_bstm_id = mysqli_real_escape_string($conn, $_POST['id_bestemming']);
$query_reizen = mysqli_query($conn, "SELECT * FROM reis  WHERE idReis = $get_reis_id");
?>

<div id="container">
    <main id="main">
        <?php include '../PHP/navbar.php';?>
            <h2 id="title_boeking">Boeking</h2>

            <section class="boeking_content">
                <div class="info_container" id="reis_info">
                    <?php
                    if(mysqli_num_rows($query_reizen) > 0) 
                    {
                        while($reis_data = mysqli_fetch_array($query_reizen)) 
                        {
                            ?>
                            <div class="box_reis" id="">
                                <div class="box_data_reis">
                                    <h3>Bestemming</h3>
                                    <p><?=$reis_data['bestemming'];?></p>
                                </div>

                                <div class="box_data_reis">
                                    <h3>Periode</h3>
                                    <p><?=$reis_data['periode'];?></p>
                                </div>
                            </div>

                            <div class="box_reis" id="">    
                                <div class="box_data_reis">
                                    <h3>Type</h3>
                                    <p><?=$reis_data['reis_type'];?></p>
                                </div>

                                <div class="box_data_reis">
                                    <h3>Vertrek</h3>
                                    <p><?=$reis_data['departure'];?></p>
                                </div>
                            </div>

                            <div class="box_reis" id="">   
                                <div class="box_data_reis">
                                    <h3>Check-in-balie</h3>
                                    <p><?=$reis_data['check_in'];?></p>
                                </div>

                                <div class="box_data_reis">
                                    <h3>Vertrek Datum</h3>
                                    <p><?=$reis_data['vertrek_date'];?></p>
                                </div>
                            </div>
                            
                            <div class="box_reis" id="">    
                                <div class="box_data_reis">
                                    <h3>Reis Nummer</h3>
                                    <p><?=$reis_data['reis_nr'];?></p>
                                </div>

                                <div class="box_data_reis">
                                    <h3>Prijs</h3>
                                    <p><?=$reis_data['prijs'];?></p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>  
                </div>

                <div class="info_container" id="acco_info">
                <?php
                $get_bstm_id = $_POST['id_bestemming'];
                $query_acco = mysqli_query($conn, "SELECT * FROM accommodatie WHERE bstmID = $get_bstm_id;");
                if(mysqli_num_rows($query_acco) > 0)
                {
                    while($data = mysqli_fetch_assoc($query_acco))
                    {
                    ?>
                    <div class="box" id="box_boeking">
                        <div class="box_data" id="">
                            <h4>Soort Accommodatie</h4>                        
                            <p><?=$data['soort'];?></p>
                        </div>

                        <div class="box_data" id="">
                            <h4>Aantal Kamers</h4>
                            <p><?=$data['kamer'];?></p>
                        </div>

                        <div class="box_data" id="">
                            <h4>Ligging</h4>
                            <p><?=$data['ligging'];?></p>
                        </div>

                        <div class="box_data" id="">
                            <h4>Faciliteiten</h4>
                            <p class=""><?=$data['faciliteit'];?></p>
                        </div>

                        <div class="box_data" id="">
                            <fiure id="" class="box_img">
                                <img src="../UPLOAD-IMG/<?php echo $data['picture'];?>">
                            </figure>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
                </div>
            </section>

        <form class="boeking_form" action="../INCLUDES/boeking.inc.php" method="POST">
            <input type="hidden" name="id_user" value="<?=$_SESSION['auth_user']['user_id'];?>">
            <input type="hidden" name="pk_reis" value="<?=$get_reis_id?>">
            <input type="hidden" name="pk_bstm" value="<?=$get_bstm_id?>">
            <button class="boek_btn" type="submit" name="boeking_btn">Boek</button>
        </form>

    </main>
</div>

<?php include '../PHP/footer.php';?>