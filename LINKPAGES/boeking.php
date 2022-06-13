<?php 
// include '../INCLUDES/authentication.php';
?>

<div id="container">
    <main id="main">
        <?php include '../PHP/navbar.php';?>
        <h1 class="h1">Reis Informatie</h1>
        <div class="boeking_info">
            <section class="info_card">
                <div class="info_card_reizen">
                    <?php 
                    $get_reis_id = $_POST['id_reis'];
                    $query_reizen = mysqli_query($conn, "SELECT * FROM reis WHERE idReis = $get_reis_id");

                    $qet_fk_acco = $_POST['id_acco'];
                    $query_bstm = mysqli_query($conn, "SELECT * FROM bestemming WHERE accommodatieID = $qet_fk_acco");
                    if(mysqli_num_rows($query_reizen) > 0) 
                    {
                        while($reis_data = mysqli_fetch_array($query_reizen)) 
                        {
                            ?>
                            <div class="card_box">
                                <div class="box">
                                    <h3>Bestemming</h3>
                                    <div class="info_box"><?=$reis_data['bestemming'];?></div>
                                    <div class="info_bstm">
                                        <?php
                                        if(mysqli_num_rows($query_bstm) > 0)
                                        {
                                            while($bstm_data = mysqli_fetch_array($query_bstm))
                                            {
                                                ?>
                                                <h4>Land</h4>
                                                <div><?=$bstm_data['land'];?></div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="box">
                                    <h3>Periode</h3>
                                    <div class="info_box"><?=$reis_data['periode'];?></div>
                                </div>
                            </div>

                            <div class="card_box">    
                                <div class="box">
                                    <h3>Type</h3>
                                    <div class="info_box"><?=$reis_data['reis_type'];?></div>
                                </div>
                                <div class="box">
                                    <h3>Vertrek</h3>
                                    <div class="info_box"><?=$reis_data['departure'];?></div>
                                </div>
                            </div>

                            <div class="card_box">   
                                <div class="box">
                                    <h3>Check-in-balie</h3>
                                    <div class="info_box"><?=$reis_data['check_in'];?></div>
                                </div>
                                <div class="box">
                                    <h3>Vertrek Datum</h3>
                                    <div class="info_box"><?=$reis_data['vertrek_date'];?></div>
                                </div>
                            </div>
                            
                            <div class="card_box">    
                                <div class="box">
                                    <h3>Reis Nummer</h3>
                                    <div class="info_box"><?=$reis_data['reis_nr'];?></div>
                                </div>
                                <div class="box">
                                    <h3>Prijs</h3>
                                    <div class="info_box"><?=$reis_data['prijs'];?></div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>  
                </div>

                <div class="info_card_accommodatie">
                <?php 
                $qet_id_acco = $_POST['id_acco'];
                $query_acco = mysqli_query($conn, "SELECT * FROM accommodatie WHERE idAcco = $qet_id_acco");
                if(mysqli_num_rows($query_acco) > 0)
                {
                    while($acco_data = mysqli_fetch_array($query_acco))
                    {
                        ?>
                        <div class="card_box" id="acco_box">
                            <h4>Soort Accommodatie</h4>                        
                            <p><?=$acco_data['soort'];?></p>
                        </div>
                        <div class="card_box" id="acco_box">
                            <h4>Aantal Kamers</h4>
                            <p><?=$acco_data['kamer'];?></p>
                        </div>
                        <div class="card_box" id="acco_box">
                            <h4>Ligging</h4>
                            <p><?=$acco_data['ligging'];?></p>
                        </div>
                        <div class="card_box" id="acco_box">
                            <h4>Faciliteiten</h4>
                            <p><?=$acco_data['faciliteit'];?></p>
                        </div>
                        <?php
                    }
                }
                ?>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include '../PHP/footer.php';?>