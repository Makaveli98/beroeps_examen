<?php
require '../PHP/header.php';
?>

<div id="container">
    <main id="main">
    <?php include '../PHP/navbar.php'; 
    ?>
        <div class="empty_div"></div>
        <div class="table_content">
            <h2>Bestemmingen</h2>
            <table>
                <thead>
                    <tr>
                        <th>Plaats</th>
                        <th>Land</th>
                        <th>Provincie</th>
                        <th>Accommodatie</th>
                    </tr>
                </thead>

                <?php 
                $query = mysqli_query($conn, "SELECT * FROM bestemming");
                if(mysqli_num_rows($query) > 0)
                {
                    while($row = mysqli_fetch_assoc($query)) 
                    {
                        ?>
                        <tbody>
                            <tr>
                                <td><?=$row['plaats'];?></td>
                                <td><?=$row['land'];?></td>
                                <td><?=$row['provincie'];?></td>
                                <td><?=$row['accommodatie'];?></td>
                            </tr>
                        </tbody>
                        <?php
                    }
                } else 
                {
                    ?>
                    <tr>
                        <td>No Record Found</td>
                        <td>No Record Found</td>
                        <td>No Record Found</td>
                        <td>No Record Found</td>
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
