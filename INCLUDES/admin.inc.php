<?php
require 'dbh.inc.php';

// bestemming invoeren
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
// end bestemming

// reizen invoeren
    if(isset($_POST['reis_submit'])) 
    {
        $bstmID = $_POST['bestemming'];
        // $acco = $_POST['acco'];
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
// end reis

// accommodatie invoeren
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
// end accommodatie

// faciliteit invoeren
    if(isset($_POST['faciliteit_submit'])) {
        $faciliteit = mysqli_real_escape_string($conn, $_POST['faciliteit']);
        
        if(empty($faciliteit)) {
            header("Location: ../ADMIN/fac.admin.php?empyFields");
            exit(0);
        }
        else {
            $sql = "INSERT INTO faciliteit (naam_fac) VALUES ('$faciliteit')";
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
// end faciliteit


// delete faciliteit
    if(isset($_POST['delete_fac'])) 
    {
        $id_fac = $_POST['hidden_v_fac'];

            $sql_delete_fac = mysqli_query($conn, "DELETE FROM faciliteit WHERE idFac = '$id_fac'");
            if($sql_delete_fac) 
            {
                header('Location: ../ADMIN/f_overview.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/f_overview_admin.php?DELETE FAIL');
                exit(0);
            }
    }
// end faciliteit delete

// delete bstm
    if(isset($_POST['delete_bstm'])) 
    {
        $id_bstm = $_POST['hidden_v_bstm'];

            $sql_delete_bstm = mysqli_query($conn, "DELETE FROM bestemming WHERE idBestemming = '$id_bstm'");
            if($sql_delete_bstm) 
            {
                header('Location: ../ADMIN/b_overview.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/b_overview_admin.php?DELETE FAIL');
                exit(0);
            }
    }
// end delete bstm


// bewerk bestemming

    if(isset($_POST['bstm_update'])) 
    {
        $get_bstm_id = $_POST['bstm_h'];
        $up_plaats_bstm = $_POST['plaats'];
        $up_land_bstm = $_POST['land'];
        $up_provincie_bstm = $_POST['provincie'];
        $up_acco_bstm = $_POST['accomodatie'];

        $update_query_bstm = mysqli_query($conn, "UPDATE bestemming 
        SET plaats = '$up_plaats_bstm', land = '$up_land_bstm', provincie = '$up_provincie_bstm', accommodatie = '$up_acco_bstm' WHERE idBestemming = '$get_bstm_id'");

        if($update_query_bstm)
        {
            header('Location: ../ADMIN/b_overview.admin.php?UPDATE SUCCES');
                exit(0);
        } else 
        {
            header('Location: ../ADMIN/bstm.bewerk.php?UPDATE FAIL');
                exit(0);
        }

    }

// end bewerk bestemming

// update accommodatie
        
    if(isset($_POST['acco_update'])) 
    {
        $get_acco_id = $_POST['acco_h'];
        $up_acco_fac = $_POST['checkbox_fac'];
        $converter_acco = implode($up_acco_fac);
        
        $up_soort_acco = $_POST['soort'];
        $up_kamer_acco = $_POST['kamer'];
        $up_ligging_acco = $_POST['ligging'];

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



                    $update_query_acco = mysqli_query($conn, "UPDATE accommodatie 
                    SET soort = '$up_soort_acco', kamer = '$up_kamer_acco', ligging = '$up_ligging_acco', faciliteit = '$converter_acco', picture = '$new_img_name' 
                    WHERE idAccommodatie = '$get_acco_id'");

                    if($update_query_acco)
                    {
                        header('Location: ../ADMIN/a_overview.admin.php?UPDATE SUCCES');
                        exit(0);
                    } else 
                    {
                        header('Location: ../ADMIN/acco.bewerk.php?UPDATE FAIL');
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
 
// end update accommodatie


// update reis
    if(isset($_POST['reis_update'])) 
        {
            $get_reis_id = $_POSTP['reis_h'];

            $get_reis_bstm = $_POST['bestemming'];
            $get_reis_periode = $_POST['periode'];
            $get_reis_type = $_POST['reis_type'];
            $get_reis_vrtk = $_POST['vertrek'];
            $get_reis_check = $_POST['check_in'];
            $get_reis_vdate = $_POST['vertrek_date'];
            $get_reis_nr = $_POST['reis_nummer'];
            $get_reis_prijs = $_POST['prijs'];

            $update_query_reis = mysqli_query($conn, "UPDATE reis 
            SET bestemming = '$get_reis_bstm', periode = '$get_reis_periode', reis_type = '$get_reis_type', departure = '$get_reis_vrtk', 
            check_in = '$get_reis_check', vertrek_date = '$get_reis_vdate', reis_nr = '$get_reis_nr', prijs = '$get_reis_prijs' 
            WHERE idReis = '$get_reis_id'");

            if($update_query_reis)
            {
                header('Location: ../ADMIN/r_overview.admin.php?UPDATE SUCCES');
                    exit(0);
            } else 
            {
                header('Location: ../ADMIN/reis.bewerk.php?UPDATE FAIL');
                    exit(0);
            }

        }

// end update reis