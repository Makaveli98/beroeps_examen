<?php
require '../PHP/header.php';
?>

<div id="container">
    <main id="main">
    <?php include '../PHP/navbar.php'; ?>
    
        <form action="../INCLUDES/search.inc.php" id="search_form" method="POST">
            <input id="input_search" name="search" placeholder="Search">
            <button type="submit" name="submit_search">Search</button>
        </form>


        <div class="table_content">
            <h2>Reizen</h2>
            <table>
                <thead>
                    <tr>
                        <th>Plaats</th>
                        <th>Periode</th>
                        <th>Reis-type</th>
                        <th>Check-in-balie</th>
                        <th>Check</th>
                    </tr>
                </thead>

                <?php 
                $query = mysqli_query($conn, "SELECT * FROM reis INNER JOIN bestemming ON reis.bestemmingID = bestemming.idBestemming");
                if(mysqli_num_rows($query) > 0)
                {
                    while($row = mysqli_fetch_assoc($query)) 
                    {
                        ?>
                        <tbody>
                            <tr>
                                <td><?=$row['plaats'];?></td>
                                <td><?=$row['periode'];?></td>
                                <td><?=$row['naam_type'];?></td>
                                <td><?=$row['check_in'];?></td>
                                <td>
                                    <form action="boeking.php" method="POST">
                                          
                                        <input type="hidden" name="id_reis" value="<?=$row['idReis'];?>">
                                        <input type="hidden" name="id_bestemming" value="<?=$row['idBestemming'];?>">
                                        <button name="bekijk_btn">Check</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                    }
                } else 
                {
                    ?>
                    <tr>
                        <td colspan="4">No Record Found</td>
                    </tr>
                    <?php
                }    
                ?>
            </table>

        </div>
    </main>
</div>
<?php 
include '../PHP/footer.php';
?>
