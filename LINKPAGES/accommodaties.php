<div id="container">
    <main id="main">
    <?php include '../PHP/navbar.php'; ?>
        <div id="table_content">
            <h1>Overzicht Accommodatie</h1>
            <table>
                <thead>
                    <tr>
                        <th>Soort</th>
                        <th>Kamer</th>
                        <th>Ligging</th>
                        <th>Faciliteit</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM accommodatie";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0) {
                        while($row = mysqli_fetch_array($query_run)){
                            ?>
                            <tr>
                                <td><?=$row['soort']; ?></td>
                                <td><?=$row['kamer']; ?></td>
                                <td><?=$row['ligging']; ?></td>
                                <td><?=$row['faciliteit']; ?></td>  
                                <td><input type="text" value="<?=$row['idAcco'];?>"></td>  
                                 
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
    </main>
</div>
<?php 
include '../PHP/footer.php';
?>
