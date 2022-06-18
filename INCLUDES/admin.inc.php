<?php
require_once 'dbh.inc.php';

// Input Reis
    if(isset($_POST['reis_submit'])) 
    {
        $bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);
        $typeID = mysqli_real_escape_string($conn, $_POST['reis_type']);
        $depID = mysqli_real_escape_string($conn, $_POST['vertrek']);

        $r_periode = mysqli_real_escape_string($conn, $_POST['periode']);
        $r_check = mysqli_real_escape_string($conn, $_POST['check_in']);
        $vtrk_date = mysqli_real_escape_string($conn, $_POST['vertrek_date']);
        $r_nr = mysqli_real_escape_string($conn, $_POST['reis_nummer']);
        $r_prijs = mysqli_real_escape_string($conn, $_POST['prijs']);


        if(empty($bstmID) || empty($typeID) || empty($depID) || empty($r_periode) || empty($r_check) 
        || empty($vtrk_date) || empty($r_nr) || empty($r_prijs)) 
        {
            header("Location: ../ADMIN/reizen.admin.php?EMPTY-FIELDS");
            exit(0);
        } else 
        { 
            $query_r = mysqli_query($conn, "INSERT INTO reis (bestemmingID, depID, typeID, periode, check_in, vertrek_date, reis_nr, prijs, bestemming)  
            VALUES ('$bstmID', '$depID', '$typeID', '$r_periode', '$r_check', '$vtrk_date', '$r_nr', '$r_prijs', 
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

        if(empty($bstm_plaats) || empty($land) || empty($provincie)) 
        {
            header("Location: ../ADMIN/bestemming.admin.php?EMPTY-FIELDS");
            exit(0);
        } 
        else 
        { 
            $query_b = mysqli_query($conn, "INSERT INTO bestemming (plaats, land, provincie) 
            VALUES ('$bstm_plaats', '$land', '$provincie')") or die (mysqli_error($conn));
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
    if(isset($_POST['submit_accommodatie']))
    {

        if(!empty($_POST['fac_checkbox'])) 
        {
            $checkbox_impl = implode(", ", $_POST['fac_checkbox']);
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
            
                        if(empty($get_bstmID) || empty($soort) || empty($kamer) || empty($ligging) || empty($new_img_name)) 
                        {
                            header('Location: ../ADMIN/accommodatie.admin.php?EMPTY FIELDS');
                            exit(0);
                        } 
                        else 
                        {
                            $query_a = mysqli_query($conn, "INSERT INTO accommodatie (bstmID, soort, kamer, ligging, faciliteit, picture, bstm_naam)
                            VALUES ('$get_bstmID', '$soort', '$kamer', '$ligging', '".$checkbox_impl."', '$new_img_name',
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
                        }
                       
                    } else 
                    {
                        header('Location: ../ADMIN/accommodatie.admin.php?Cant Upload Typefile');
                        exit(0);
                    }
                    
                }
            }   
        } else 
        {
            header('Location: ../ADMIN/accommodatie.admin.php?Empty!!!');
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

// Input Dep
    if(isset($_POST['dep_submit'])) {
        $dep = mysqli_real_escape_string($conn, $_POST['dep']);
        
        if(empty($dep)) {
            header("Location: ../ADMIN/dep.admin.php?empyFields");
            exit(0);
        }
        else {
            $sql = mysqli_query($conn, "INSERT INTO departures (departure) VALUES ('$dep')");
            if($sql) {
                header('Location: ../ADMIN/dep.admin.php?SUCCES');
                exit(0);
            } else {
                header('Location: ../ADMIN/dep.admin.php?SOMETHING-WENT-WRONG');
                exit(0);
            }
        }
    }
// end Input

// Input Reis Type
    if(isset($_POST['type_submit'])) {
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        
        if(empty($type)) {
            header("Location: ../ADMIN/reis_type.admin.php?empyFields");
            exit(0);
        }
        else {
            $sql = mysqli_query($conn, "INSERT INTO reis_type (name_type) VALUES ('$type')");
            if($sql) {
                header('Location: ../ADMIN/reis_type.admin.php?SUCCES');
                exit(0);
            } else {
                header('Location: ../ADMIN/reis_type.admin.php?SOMETHING-WENT-WRONG');
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
            header('Location: ../ADMIN/reis.bewerk.php?UPDATE SUCCES');
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
        $get_bstm_id = mysqli_real_escape_string($conn, $_POST['id_bestemming']);
        $upd_plaats_bstm = mysqli_real_escape_string($conn, $_POST['plaats']);
        $upd_land_bstm = mysqli_real_escape_string($conn, $_POST['land']);
        $upd_provincie_bstm = mysqli_real_escape_string($conn, $_POST['provincie']);

        $update_query_bstm = mysqli_query($conn, "UPDATE bestemming SET plaats = '$upd_plaats_bstm', 
        land = '$upd_land_bstm', provincie = '$upd_provincie_bstm' WHERE idBestemming = '$get_bstm_id'");

        if($update_query_bstm)
        {
            header('Location: ../ADMIN/bestemming.admin.php?UPDATE SUCCES');
                exit(0);
        } else 
        {
            header('Location: ../ADMIN/bstm.bewerk.php?UPDATE FAIL');
                exit(0);
        }

    }

// end Update

// Update Accommodatie
    if(isset($_POST['acco_update'])) {

        if(!empty($_POST['fac_checkbox']))
        {
            $checkbox_implode = implode(", ", $_POST['fac_checkbox']);

            $id_acco = mysqli_real_escape_string($conn, $_POST['id_acco']);
            $bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);
            $_soort = mysqli_real_escape_string($conn, $_POST['soort']);
            $_kamer = mysqli_real_escape_string($conn, $_POST['kamer']);
            $_ligging = mysqli_real_escape_string($conn, $_POST['ligging']);

            $_img_name = $_FILES['image']['name'];
            $_img_size = $_FILES['image']['size'];
            $_img_tmp = $_FILES['image']['tmp_name'];
            $_error = $_FILES['image']['error'];

            if($_error === 0) 
            {
                if($_img_size > 1000000)
                {
                    header('Location: ../ADMIN/accommodatie.admin.php?FILETOLARGE');
                    exit(0);
                } else 
                {
                    $_img_ex = pathinfo($_img_name, PATHINFO_EXTENSION);
                    $_img_ex_lc = strtolower($_img_ex);
                    $_allowed_exs = array("jpg", "jpeg", "png");

                    if(in_array($_img_ex_lc, $_allowed_exs)) 
                    {
                        $_new_img_name = uniqid("IMG-", true).'.'.$_img_ex_lc;
                        $_img_upload_path = '../UPLOAD-IMG/'.$_new_img_name;
                        move_uploaded_file($_img_tmp, $_img_upload_path);
            
                        
                        $sql_update = mysqli_query($conn, "UPDATE accommodatie 
                        SET soort = '$_soort', kamer = '$_kamer', ligging = '$_ligging', 
                        faciliteit = '$checkbox_implode', picture = '$_new_img_name' 
                        WHERE idAcco = '$id_acco'");

                        if($sql_update)
                        {
                            header('Location: ../ADMIN/accommodatie.admin.php?UpdateSucces');
                            exit(0);
                        } else 
                        {
                            header('Location: ../ADMIN/accommodatie.admin.php?UpdateNoSucces');
                            exit(0);
                        }
                    
                    } else 
                    {
                        header('Location: ../ADMIN/accommodatie.admin.php?CantUploadTypefile');
                        exit(0);
                    }
                }
            }
        } else 
        {
            header('Location: ../ADMIN/accommodatie.admin.php?empty!!!');
            // header('Location: ../ADMIN/acco.bewerk.php?empty!!!');
            exit(0);
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
            header('Location: ../ADMIN/reizen.admin.php?DELETE SUCCES');
            exit(0);
        } else 
        {
            header('Location: ../ADMIN/reizen.php?DELETE FAIL');
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
                header('Location: ../ADMIN/bestemming.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/bestemming.admin.php?DELETE FAIL');
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
                header('Location: ../ADMIN/accommodatie.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/accommodatie.admin.php?DELETE FAIL');
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
                header('Location: ../ADMIN/fac.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/fac.admin.php?DELETE FAIL');
                exit(0);
            }
    }
// end Delete

// Delete Dep
    if(isset($_POST['delete_dep'])) 
    {
        $id_dep = mysqli_real_escape_string($conn, $_POST['departure']);

            $sql_delete_dep = mysqli_query($conn, "DELETE FROM departures WHERE idDeparture = '$id_dep'");
            if($sql_delete_dep) 
            {
                header('Location: ../ADMIN/dep.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/dep.admin.php?DELETE FAIL');
                exit(0);
            }
    }
// end Delete

// Delete Reis Type
    if(isset($_POST['delete_type'])) 
    {
        $id_type = mysqli_real_escape_string($conn, $_POST['reis_type']);

            $sql_delete_type = mysqli_query($conn, "DELETE FROM reis_type WHERE idType = '$id_type'");
            if($sql_delete_type) 
            {
                header('Location: ../ADMIN/reis_type.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/reis_type.admin.php?DELETE FAIL');
                exit(0);
            }
    }
// end Delete

// Delete Boeking
    if(isset($_POST['delete_boeking'])) 
    {
        $id_boeking = mysqli_real_escape_string($conn, $_POST['boeking_id']);

            $sql_delete = mysqli_query($conn, "DELETE FROM boeking WHERE idBoeking = '$id_boeking'");
            if($sql_delete) 
            {
                header('Location: ../ADMIN/index.admin.php?DELETE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/index.admin.php?DELETE FAIL');
                exit(0);
            }
    }
// end Delete