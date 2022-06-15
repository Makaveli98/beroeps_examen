<div id="container">
    <main id="main">
    <?php include '../PHP/navbar.php'; ?>

        <div class="empty_div"></div>
        
        <div class="acco_container">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM accommodatie");
            if(mysqli_num_rows($query) > 0)
            {
                while($data = mysqli_fetch_assoc($query)) 
                {
                    ?>
                    <div class="box_wrapper">
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

                        <div class="box_data" id="fac_box">
                            <h4>Faciliteiten</h4>
                            <p class="fac_text"><?=$data['faciliteit'];?></p>
                        </div>

                        <div class="box_data" id="">
                            <fiure id="box_figure" class="img_card">
                                <img src="../UPLOAD-IMG/<?php echo $data['picture'];?>">
                            </figure>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </main>
</div>
<?php 
include '../PHP/footer.php';
?>
