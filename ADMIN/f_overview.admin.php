<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Overzicht Faciliteiten</h1>
        <div class="fac_container">
            <div class="fac_wrapper">

            <?php
            $query = "SELECT * FROM faciliteit";
            $query_run = mysqli_query($conn, $query);

            if(mysqli_num_rows($query_run) > 0) {
                while($row = mysqli_fetch_array($query_run)){
                ?>
                <form action="../INCLUDES/admin.inc.php" method="POST">
                    <div class="name_fac"><h4><?=$row['naam_fac'];?></h4>
                        <input type="hidden" name="pk_acco" value="<?=$row['idAcco'];?>">
                        <a href="f_overview_admin.php"><button class="fac_delete_btn" name="delete_fac">Delete</button></a>
                    </div>
                </form>
                <?php
                }
            }
            else {
                echo "No Records Found";
            }
            ?>
            </div>
        </div>

        <section id="overview_btns">
            <div class="overview_btn" id="overview_bstm">
                <a href="b_overview.admin.php"><button type="">Overzicht Bestemming</button></a>
            </div>

            <div class="overview_btn" id="overview_acco">
                <a href="a_overview.admin.php"><button type="">Overzicht Accommodatie</button></a>
            </div>

            <div class="overview_btn" id="overview_reizen">
                <a href="r_overview.admin.php"><button type="">Overzicht Reizen</button></a>
            </div>

            <div class="overview_btn" id="btn_back">
                <a href="fac.admin.php"><button type="">Toevoegen</button></a>
            </div>
        </section>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

