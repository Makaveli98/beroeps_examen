<div id="container">
    <main id="main">
    <?php include '../PHP/navbar.php'; ?>
        <div id="table_content">
            <h1>Overzicht Bestemmingen</h1>
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
                        <td colspan="4">No Record Found</td>
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
