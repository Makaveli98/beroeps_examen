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

        <div class="overview" id="overview_btns">
            <div class="overview_btn" id="overview_acco">
                <a href="a_overview.admin.php"><button type="">Overzicht</button></a>
            </div>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>





    