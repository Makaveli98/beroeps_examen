<?php
require 'dbh.inc.php';

// bestemming
if(isset($_POST['bestemming_submit'])) 
{
    $accoID = $_POST['accomodatie'];
    $bestemming_plaats = mysqli_real_escape_string($conn, $_POST['plaats']);
    $bestemming_land = mysqli_real_escape_string($conn, $_POST['land']);
    $bestemming_provincie = mysqli_real_escape_string($conn, $_POST['provincie']);

    if(empty($accoID) || empty($bestemming_plaats) || empty($bestemming_land) || empty($bestemming_provincie)) 
    {
        header("Location: ../ADMIN/bestemming.admin.php?EMPTY-FIELDS");
        exit(0);
    } else 
    { 
        $query_b = mysqli_query($conn, "INSERT INTO bestemming (accommodatieID, plaats, land, provincie, accommodatie) 
        VALUES ('$accoID', '$bestemming_plaats', '$bestemming_land', '$bestemming_provincie', 
        (SELECT soort FROM accommodatie WHERE idAcco = $accoID))") or die (mysqli_error($conn));
        if ($query_b) 
        {
            header("Location: ../ADMIN/bestemming.admin.php?succes");
            exit(0);   
        } else 
        {
            header("Location: ../ADMIN/bestemming.admin.php?no-succes");
            exit(0);
        }
    }   
}   


// reizen
if(isset($_POST['reis_submit'])) 
{
    $bstmID = $_POST['bestemming'];
    $r_periode = mysqli_real_escape_string($conn, $_POST['periode']);
    $r_type = mysqli_real_escape_string($conn, $_POST['reis_type']);
    $r_dep = mysqli_real_escape_string($conn, $_POST['vertrek']);
    $r_check = $_POST['check_in'];
    $r_vrtk = $_POST['vertrek_date'];
    $r_nr = mysqli_real_escape_string($conn, $_POST['reis_nummer']);
    $r_prijs = mysqli_real_escape_string($conn, $_POST['prijs']);



    if(empty($bstmID) || empty($r_periode) || empty($r_type) || empty($r_dep) || empty($r_check) 
    || empty($r_vrtk)  || empty($r_nr) || empty($r_dep) || empty($r_prijs)) 
    {
        header("Location: ../ADMIN/reizen.admin.php?EMPTY-FIELDS");
        exit(0);
    } else 
    { 
        $query_r = mysqli_query($conn, "INSERT INTO reis (bestemmingID, periode, reis_type, departure, check_in, vertrek_date, reis_nr, prijs, bestemming)  
        VALUES ('$bstmID', '$r_periode', '$r_type', '$r_dep', '$r_check', '$r_vrtk', '$r_nr', '$r_prijs', 
        (SELECT plaats FROM bestemming WHERE idBestemming = $bstmID))") or die (mysqli_error($conn));
        if ($query_r) 
        {
            header("Location: ../ADMIN/reizen.admin.php?succes");
            exit(0);   
        } else 
        {
            header("Location: ../ADMIN/reizen.admin.php?no-succes");
            exit(0);
        }
    }   
}   



if(isset($_POST['submit_accommodatie'])) {
    $fac = $_POST['checkbox_fac'];
    $converter = implode($fac);
    $soort = mysqli_real_escape_string($conn, $_POST['soort']);
    $kamer = mysqli_real_escape_string($conn, $_POST['kamer']);
    $ligging = mysqli_real_escape_string($conn, $_POST['ligging']);

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $img_tmp = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if($error === 0) 
    {
        if($img_size > 1000000)
        {
            header('Location: ../ADMIN/accommodatie.admin.php?FILE TO LARGE');
            exit(0);
        } else 
        {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            if(in_array($img_ex_lc, $allowed_exs)) 
            {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../UPLOAD-IMG/'.$new_img_name;
                move_uploaded_file($img_tmp, $img_upload_path);

                $query_a = mysqli_query($conn, "INSERT INTO accommodatie (soort, kamer, ligging, faciliteit, picture)
                VALUES ('$soort', '$kamer', '$ligging', '$converter', '$new_img_name')");

                if($query_a)
                {
                    header('Location: ../ADMIN/accommodatie.admin.php?succes');
                    exit(0);
                } else 
                {
                    header('Location: ../ADMIN/accommodatie.admin.php?try again');
                    exit(0);
                }
            } else 
            {
                header('Location: ../ADMIN/accommodatie.admin.php?Cant Upload Typefile');
                exit(0);
            }
            
        }
    }
}

// faciliteiten
if(isset($_POST['faciliteit_submit'])) {
    // require 'dbh.inc.php';
    $faciliteit = mysqli_real_escape_string($conn, $_POST['faciliteit']);
    
    if(empty($faciliteit)) {
        header("Location: ../ADMIN/fac.admin.php?empyFields");
        exit(0);
    }
    else {
        $sql = "INSERT INTO faciliteit (faciliteit) VALUES ('$faciliteit')";
        $sql_run = mysqli_query($conn, $sql);

        if($sql_run) {
            header('Location: ../ADMIN/fac.admin.php?SUCCES');
            exit(0);
        } else {
            header('Location: ../ADMIN/fac.admin.php?SOMETHING-WENT-WRONG');
            exit(0);
        }
    }
}