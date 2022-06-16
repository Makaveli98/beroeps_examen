<?php
require_once 'dbh.inc.php';

// Input Reis
    if(isset($_POST['reis_submit'])) 
    {
        $bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);
        $r_periode = mysqli_real_escape_string($conn, $_POST['periode']);
        $r_type = mysqli_real_escape_string($conn, $_POST['reis_type']);
        $r_dep = mysqli_real_escape_string($conn, $_POST['vertrek']);
        $r_check = mysqli_real_escape_string($conn, $_POST['check_in']);
        $r_vrtk = mysqli_real_escape_string($conn, $_POST['vertrek_date']);
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
// end Input

// Input Bestemming
    if(isset($_POST['bestemming_submit'])) 
    {
        $bstm_plaats = mysqli_real_escape_string($conn, $_POST['plaats']);
        $land = mysqli_real_escape_string($conn, $_POST['land']);
        $provincie = mysqli_real_escape_string($conn, $_POST['provincie']);
        $accommodatie = $_POST['checkbox_acco'];
        $conv_acco = implode($accommodatie);

        if(empty($bstm_plaats) || empty($land) || empty($provincie) || empty($accommodatie)) 
        {
            header("Location: ../ADMIN/bestemming.admin.php?EMPTY-FIELDS");
            exit(0);
        } else 
        { 
            $query_b = mysqli_query($conn, "INSERT INTO bestemming (plaats, land, provincie, accommodatie) 
            VALUES ('$bstm_plaats', '$land', '$provincie', '$conv_acco')") or die (mysqli_error($conn));
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
// end Input

// Input Accommodatie
    if(isset($_POST['submit_accommodatie'])) {
        $fac = $_POST['checkbox_fac'];
        $converter = implode($fac);
        
        $get_bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);
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

                    $query_a = mysqli_query($conn, "INSERT INTO accommodatie (bstmID, soort, kamer, ligging, faciliteit, picture, bstm_naam)
                    VALUES ('$get_bstmID', '$soort', '$kamer', '$ligging', '$converter', '$new_img_name',
                    (SELECT plaats FROM bestemming WHERE idBestemming = $get_bstmID))") or die (mysqli_error($conn));

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
// end Input

// Input Faciliteit
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
// end Input


// Update Reis
    if(isset($_POST['reis_update'])) 
    {
        $get_reis_id = mysqli_real_escape_string($conn, $_POST['reis_h']);
        $get_reis_bstm = mysqli_real_escape_string($conn, $_POST['bestemming']);
        $get_reis_periode = mysqli_real_escape_string($conn,  $_POST['periode']);
        $get_reis_type = mysqli_real_escape_string($conn,  $_POST['reis_type']);
        $get_reis_vertrek = mysqli_real_escape_string($conn, $_POST['vertrek']);
        $get_reis_check = mysqli_real_escape_string($conn, $_POST['check_in']);
        $get_reis_datum = mysqli_real_escape_string($conn, $_POST['vertrek_date']);
        $get_reis_nr = mysqli_real_escape_string($conn, $_POST['reis_nummer']);
        $get_reis_prijs = mysqli_real_escape_string($conn, $_POST['prijs']);

        $update_query_reis = mysqli_query($conn, "UPDATE reis 
        SET bestemming = '$get_reis_bstm', periode = '$get_reis_periode', reis_type = '$get_reis_type', departure = '$get_reis_vertrek', 
        check_in = '$get_reis_check', vertrek_date = '$get_reis_datum', reis_nr = '$get_reis_nr', prijs = '$get_reis_prijs' 
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

// end Update

// Update Bestemming
    if(isset($_POST['bstm_update'])) 
    {
        $get_bstm_id = mysqli_real_escape_string($conn, $_POST['bstm_h']);
        $up_plaats_bstm = mysqli_real_escape_string($conn, $_POST['plaats']);
        $up_land_bstm = mysqli_real_escape_string($conn, $_POST['land']);
        $up_provincie_bstm = mysqli_real_escape_string($conn, $_POST['provincie']);
        $up_acco_bstm = mysqli_real_escape_string($conn, $_POST['accomodatie']);

        $update_query_bstm = mysqli_query($conn, "UPDATE bestemming 
        SET plaats = '$up_plaats_bstm', land = '$up_land_bstm', provincie = '$up_provincie_bstm', accommodatie = '$up_acco_bstm' 
        WHERE idBestemming = '$get_bstm_id'");

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

// end Update

// Update Accommodatie
    if(isset($_POST['acco_update'])) 
    {
        $get_acco_id = mysqli_real_escape_string($conn, $_POST['acco_h']);
        $up_acco_fac = $_POST['checkbox_fac'];
        $converter_acco = implode($up_acco_fac);
        
        $up_soort_acco = mysqli_real_escape_string($conn, $_POST['soort']);
        $up_kamer_acco = mysqli_real_escape_string($conn, $_POST['kamer']);
        $up_ligging_acco = mysqli_real_escape_string($conn, $_POST['ligging']);

        $img_name_upd = mysqli_real_escape_string($conn, $_FILES['image']['name']);
        $img_size_upd = mysqli_real_escape_string($conn, $_FILES['image']['size']);
        $img_tmp_upd = mysqli_real_escape_string($conn, $_FILES['image']['tmp_name']);
        $error_upd = mysqli_real_escape_string($conn, $_FILES['image']['error']);


        if($error_upd === 0) 
        {
            if($img_size_upd > 1000000)
            {
                header('Location: ../ADMIN/acco.bewerk.php?FILE TO LARGE');
                exit(0);
            } else 
            {
                $img_ex_upd = pathinfo($img_name_upd, PATHINFO_EXTENSION);
                $img_ex_lc_upd = strtolower($img_ex_upd);
                $allowed_exs_upd = array("jpg", "jpeg", "png");

                if(in_array($img_ex_lc_upd, $allowed_exs_upd)) 
                {
                    $new_img_name_upd = uniqid("IMG-", true).'.'.$img_ex_lc_upd;
                    $img_upload_path_upd = '../UPLOAD-IMG/'.$new_img_name_upd;
                    move_uploaded_file($img_tmp, $img_upload_path_upd);



                    $update_query_acco = mysqli_query($conn, "UPDATE accommodatie 
                    SET soort = '$up_soort_acco', kamer = '$up_kamer_acco', ligging = '$up_ligging_acco', faciliteit = '$converter_acco', picture = '$new_img_name_upd' 
                    WHERE idAcco = '$get_acco_id'");

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
 
// end Update

// Delete Reis 
    if(isset($_POST['delete_reis'])) 
    {
        $id_reis = mysqli_real_escape_string($conn, $_POST['hidden_v_reis']);
        $sql_delete_reis = mysqli_query($conn, "DELETE FROM reis WHERE idReis = '$id_reis'");
        if($sql_delete_reis) 
        {
            header('Location: ../ADMIN/r_overview.admin.php?DELETE SUCCES');
            exit(0);
        } else 
        {
            header('Location: ../ADMIN/r_overview_admin.php?DELETE FAIL');
            exit(0);
        }
    }
// end Delete

// Delete Bestemming
    if(isset($_POST['delete_bstm'])) 
    {
        $id_bstm = mysqli_real_escape_string($conn, $_POST['hidden_v_bstm']);

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
// end Delete

// Delete Accommodatie
    if(isset($_POST['delete_acco'])) 
    {
        $id_acco = mysqli_real_escape_string($conn, $_POST['hidden_v_acco']);

            $sql_delete_acco = mysqli_query($conn, "DELETE FROM accommodatie WHERE idAcco = '$id_acco'");
            if($sql_delete_acco) 
            {
                header('Location: ../ADMIN/a_overview.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/a_overview_admin.php?DELETE FAIL');
                exit(0);
            }
    }
// end Delete


// Delete Faciliteit
    if(isset($_POST['delete_fac'])) 
    {
        $id_fac = mysqli_real_escape_string($conn, $_POST['fac_naam']);

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
// end Delete
