<?php
require '../PHP/header.php';
?>

<div id="container">
    <main id="main">
    <?php include '../PHP/navbar.php'; ?>
    <h2 class="acco_title">Accommodatie</h2>        
        <div class="acco_overview">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM accommodatie");
            if(mysqli_num_rows($query) > 0)
            {
                while($data = mysqli_fetch_assoc($query)) 
                {
                    ?>
                    <div class="box">
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
                            <p class="fac_text"><?=$data['faciliteit'];?></p>
                        </div>

                        <div class="box_data" id="img_data">
                            <fiure id="" class="box_img">
                                <img class="img" src="../UPLOAD-IMG/<?php echo $data['picture'];?>">
                            </figure>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No Records Found";
            }
            ?>
        </div>
    </main>
</div>
<?php 
include '../PHP/footer.php';
?>
