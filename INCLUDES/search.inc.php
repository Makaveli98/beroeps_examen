<?php
require_once 'dbh.inc.php';

if(isset($_POST['submit_search'])) 
{    
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $query_r = mysqli_query($conn, "SELECT * FROM reis WHERE bestemming LIKE '%$search%' 
    OR periode LIKE '%$search%' OR reis_type LIKE '%$search%'") or die (mysqli_error($conn));

    if(mysqli_num_rows($query_r) > 0) 
    {
        ?>  
        <h3>There are <?=$query_r?>results</h3>
        <?php

        header('Location: ../LINKPAGES/reizen.php');

        while($q_data = mysqli_fetch_assoc($query_r)) 
        {
            ?>
            <tr>
                <td><?=$q_data['bestemming']; ?></td>
                <td><?=$q_data['periode']; ?></td>
                <td><?=$q_data['reis_type']; ?></td>
                <td><?=$q_data['departure']; ?></td>   
                <td><?=$q_data['check_in']; ?></td>   
                <td><?=$q_data['vertrek_date']; ?></td>   
                <td><?=$q_data['reis_nr']; ?></td>
                <td><?=$q_data['prijs']; ?></td>
                <td><form action="../INCLUDES/boeking.php" method="POST">
                    <button name="reis_btn">BOEKEN</button>
                    <input type="hidden" name="id_reis" value="<?=$q_data['idReis'];?>">
                    <input type="hidden" name="bstm" value="<?=$q_data['bestemming'];?>">
                    <input type="hidden" name="r_nr" value="<?=$q_data['reis_nr'];?>">
                </form></td>
            </tr>
            <?php
        }
    } else 
    {
        ?>
        <h3>There are no results matching your search!</h3>
        <?php
    }
}