<?
$idartikel = $_GET['bewerk'];

    if(isset($_POST['product_bewerken'])) {
        $naam = $_POST['naam'];
        $omschrijving = $_POST['omschrijving'];
        $prijs = $_POST['prijs'];
        $foto = $_FILES['foto']['name'];
        // $foto_tmp_name = $_FILES['foto']['tmp_name'];
        $foto_folder = '..pic/'.$foto;

        if(empty($naam)  empty($omschrijving)  empty($prijs) || empty($foto)) {
            $message[] = 'Vul alles in';
        } 
        else {
            $query = "UPDATE artikel SET naam = '$naam', omschrijving = '$omschrijving', prijs = '$prijs', foto = '$foto'
            WHERE idartikel = $idartikel";
            $query_run = mysqli_query($conn,$query);

            if($query) {
                $message[] = 'Product bewerkt gelukt!';
            }
            else {
                $message[] = 'Kan niet toevoegen';
            }

        } 
    }