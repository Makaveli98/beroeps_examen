<?php
require '../PHP/header.php';

if(isset($_POST['submit_search'])) 
{    
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM reis
    -- INNER JOIN departures ON reis.typeID = departures.idType 
    WHERE bestemming LIKE '%$search%' OR periode LIKE '%$search%' OR naam_type LIKE '%$search%'" or die (mysqli_error($conn));
    $result = mysqli_query($conn, $sql);
    $query_result = mysqli_num_rows($result);
    ?>

    <div id="container">
        <main id="main">
            <?php include '../PHP/navbar.php';?>
            <div class="table_content">
            <h2>Reizen</h2>
            <table>
                <thead>
                    <tr>
                        <th>Plaats</th>
                        <th>Periode</th>
                        <th>Reis-type</th>
                        <th>Check-in-balie</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                                
                    if($query_result > 0) 
                    {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?=$row['bestemming']; ?></td>
                                <td><?=$row['periode']; ?></td>
                                <td><?=$row['naam_type']; ?></td>
                                <td><?=$row['check_in']; ?></td>   
                                <td>
                                    <form action="../LINKPAGES/boeking.php" method="POST">
                                        <button name="bekijk_btn">Check</button>
                                      
                                        <input type="hidden" name="id_reis" value="<?=$row['idReis'];?>">
                                        <input type="hidden" name="id_bestemming" value="<?=$row['bestemmingID'];?>">
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else 
                    {
                        header('Location: ../LINKPAGES/reizen.php?no_results_in_query');
                        exit(0);
                    }

                ?>
            </div>
            <table>
        </main>
    </div>
<?php
}



