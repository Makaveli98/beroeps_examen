<?php 
include '../INCLUDES/authentication.php';
?>

<div id="container_a">
    <?php include '../PHP/header.php';
    include 'navbar.admin.php';?>
    <main id="main_a">
        <h1>Overzicht Bestemming</h1>
        <div id="table_content_a">
            <table>
                <thead>
                    <tr>
                        <th>Plaats</th>
                        <th>Land</th>
                        <th>Provincie</th>
                        <th>Accommodatie</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM bestemming";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0) {
                    while($row = mysqli_fetch_array($query_run)){
                        ?>
                        <tr>
                            <td><?=$row['plaats']; ?></td>
                            <td><?=$row['land']; ?></td>
                            <td><?=$row['provincie']; ?></td>
                            <td><?=$row['accommodatie']; ?></td>   
                        </tr>
                        <?php
                    }
                }
                else {
                    ?>
                    <tr>
                        <td colspan="3">No Record Found</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>  
        
        <section id="overview_btns">
            <div class="overview_btn" id="overview_acco">
                <a href="a_overview.admin.php"><button type="">Overzicht Accommodatie</button></a>
            </div>

            <div class="overview_btn" id="overview_fac">
                <a href="f_overview.admin.php"><button type="">Overzicht Faciliteit</button></a>
            </div>

            <div class="overview_btn" id="overview_reizen">
                <a href="r_overview.admin.php"><button type="">Overzicht Reizen</button></a>
            </div>

            <div class="overview_btn" id="btn_back">
                <a href="bestemming.admin.php"><button type="">Toevoegen</button></a>
            </div>
        </section>
    </main>
</div>


<?php include '../PHP/footer.php'; ?>

