<?php 
require '../PHP/header.php';
if($_SESSION['auth_role'] == '0' || $_SESSION['auth_role'] == NULL)
{   
    header('Location: ../PHP/index.php?YouAreNotTheAdmin');
    exit(0);
}
?>

<div id="container_a">
    <?php include 'navbar.admin.php';?>

    <main id="main_a">
        <h1>Bestemming Updaten</h1>
        <div id="input_content">
            <?php
            $get_idBstm = mysqli_real_escape_string($conn, $_POST['bstm_hidden']);
            $sql_update = mysqli_query($conn, "SELECT * FROM bestemming WHERE idBestemming = $get_idBstm");
            if(mysqli_num_rows($sql_update) > 0) 
            {
                while($update = mysqli_fetch_array($sql_update)) 
                {
                    ?>
                    <form id="input_bstm" class="input" action="../INCLUDES/admin.inc.php" method="POST">

                        <!-- input field voor de plaats van de bestemming -->
                        <div>
                            <label for="">Plaats:</label><br>
                            <input type="text" name="plaats" placeholder="Plaats..." value="<?=$update['plaats'];?>">
                        </div>

                        <!-- input field voor het land van de bestemming -->
                        <div>
                            <label for="">Land:</label><br>
                            <input type="text" name="land" placeholder="Land..." value="<?=$update['land'];?>">
                        </div>

                        <!-- input field voor de provincie van de bestemming -->
                        <div>
                            <label for="">Provincie:</label><br>
                            <input type="text" name="provincie" placeholder="provincie..." value="<?=$update['provincie'];?>">
                        </div>
                            <input type="text" name="id_bestemming" value="<?=$update['idBestemming'];?>">
                            <button class="submit_btn" id="btn_bstm" type="submit" name="bstm_update">Update</button>
                        </form>
                    <?php
                }
            }
            ?>
            <a href="bestemming.admin.php"><button class="submit_btn" id="btn_bstm_terug" type="submit">Terug</button></a>
        </div>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

