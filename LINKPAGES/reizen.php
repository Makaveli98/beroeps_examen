<div id="container">
    <main id="main">
    <?php include '../PHP/navbar.php'; ?>
        <form action="../INCLUDES/search.inc.php" id="search_form" method="POST">
            <input id="input_search" name="search" placeholder="Search">
            <button type="submit" name="submit_search">Search</button>

        </form>
        <div id="table_content">
            <h1>Overzicht Reizen</h1>
            <table>
                <thead>
                    <tr>
                        <th>Plaats</th>
                        <th>Periode</th>
                        <th>Type</th>
                        <th>Vertrek</th>
                        <th>Check-in-balie</th>
                        <th>Vertrek Datum</th>
                        <th>Reis Nummer</th>
                        <th>Prijs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM reis");
                    $query_2 = mysqli_query($conn, "SELECT * FROM bestemming");
                    if(mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td><?=$row['bestemming']; ?></td>
                                <td><?=$row['periode']; ?></td>
                                <td><?=$row['reis_type']; ?></td>
                                <td><?=$row['departure']; ?></td>   
                                <td><?=$row['check_in']; ?></td>   
                                <td><?=$row['vertrek_date']; ?></td>   
                                <td><?=$row['reis_nr']; ?></td>
                                <td><?=$row['prijs']; ?></td>
                                <td>
                                    <form action="boeking.php?=<?=$row['idReis']?>" method="POST">
                                        <button name="bekijk_btn">BOEKEN</button>
                                        <input type="text" name="id_reis" value="<?=$row['idReis'];?>">
                                        <input type="text" name="id_bestemming" value="<?=$row['bestemmingID'];?>">
                                        <?php 
                                        while($row_2 = mysqli_fetch_array($query_2))
                                        {
                                            ?>
                                            <input type="text" name="id_acco" value="<?=$row_2['accommodatieID'];?>">
                                            <?php
                                            
                                        }
                                        ?>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="8">No Record Found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<?php 
include '../PHP/footer.php';
?>
