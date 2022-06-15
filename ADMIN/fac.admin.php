<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
 
    <main id="main_a">
        <h1>Faciliteit Invoegen</h1>
        <div id="input_content">
            <form id="input_fac" class="input" action="../INCLUDES/admin.inc.php" method="POST">
                <div>
                    <label for="">Faciliteit:</label>
                    <input type="text" name="faciliteit" placeholder="Faciliteit...">
                </div>

                <div class="submit_btn" id="fac_btn">
                    <button type="submit" name="faciliteit_submit">Add</button>
                </div>
            </form>
        </div>

        <div class="overview" id="overview_btns">
            <div class="overview_btn" id="overview_fac">
                <a href="f_overview.admin.php"><button type="">Overzicht</button></a>
            </div>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

