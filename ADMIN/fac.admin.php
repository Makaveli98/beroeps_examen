<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <!-- <div class="back_btn">
        <a href="reizen.admin.php"><button type="">Terug</button></a>
    </div> -->
    <main id="main_a">
        <h1>Faciliteit Invoegen</h1>
        <div id="input_content">
            <form id="input_fac" class="input" action="../INCLUDES/admin.inc.php" method="POST">
                <!-- input van de faciliteit -->
                <!-- het liefst heb ik verschillende input velden voor hetzelfde column in de database en dat 1 maar NOT NULL is -->
                <!-- MAAR DIT IS NIET ZO BELANGRIJK -->
                <div>
                    <label for="">Faciliteit:</label>
                    <input type="text" name="faciliteit" placeholder="faciliteit...">
                </div>

                <div class="submit_btn" id="fac_btn">
                    <button type="submit" name="faciliteit_submit">Add</button>
                </div>
            </form>
        </div>

        <div class="overview" id="ov_btn">
            <a href="f_overview.admin.php"><button type="">Overzicht</button></a>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

