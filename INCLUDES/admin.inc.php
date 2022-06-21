<?php
require_once 'dbh.inc.php';

// Input Reis
    // kijken of de knop ingedrukt wordt 
    if(isset($_POST['reis_submit'])) 
    {
        // het initialiseren van variabelen en die een value geven
        $bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);
        $type = mysqli_real_escape_string($conn, $_POST['reis_type']);
        $depID = mysqli_real_escape_string($conn, $_POST['vertrek']);

        $r_periode = mysqli_real_escape_string($conn, $_POST['periode']);
        $r_check = mysqli_real_escape_string($conn, $_POST['check_in']);
        $vtrk_date = mysqli_real_escape_string($conn, $_POST['vertrek_date']);
        $r_nr = mysqli_real_escape_string($conn, $_POST['reis_nummer']);
        $r_prijs = mysqli_real_escape_string($conn, $_POST['prijs']);

        // kijken of de input field empty is
        if(empty($bstmID) || empty($type) || empty($depID) || empty($r_periode) || empty($r_check) 
        || empty($vtrk_date) || empty($r_nr) || empty($r_prijs)) 
        {
            header("Location: ../ADMIN/reizen.admin.php?EMPTY-FIELDS");
            echo "Velden moeten ingevuld worden!";
            exit(0);
        } else 
        { 
            // als de input field niet empty is dan voer je de ingevulde gegevens in
            $query_r = mysqli_query($conn, "INSERT INTO reis (bestemmingID, depID, naam_type, periode, check_in, vertrek_date,
            reis_nr, prijs, bestemming)  
            VALUES ('$bstmID', '$depID', '$type', '$r_periode', '$r_check', '$vtrk_date', '$r_nr', '$r_prijs', 
            (SELECT plaats FROM bestemming WHERE idBestemming = $bstmID))") or die (mysqli_error($conn));
            if ($query_r) 
            {
                header("Location: ../ADMIN/reizen.admin.php?succes");
                echo "Succes";
                exit(0);   
            } else 
            {
                header("Location: ../ADMIN/reizen.admin.php?no-succes");
                echo "fail";
                exit(0);
            }
        }   
    }   
// end Input

// Input Bestemming
    // kijken of de knop ingedrukt wordt 
    if(isset($_POST['bestemming_submit'])) 
    {
        // het initialiseren van variabelen en die een value geven
        $bstm_plaats = mysqli_real_escape_string($conn, $_POST['plaats']);
        $land = mysqli_real_escape_string($conn, $_POST['land']);
        $provincie = mysqli_real_escape_string($conn, $_POST['provincie']);

        // kijken of de input field empty is
        if(empty($bstm_plaats) || empty($land) || empty($provincie)) 
        {
            header("Location: ../ADMIN/bestemming.admin.php?EMPTY-FIELDS");
            exit(0);
        } 
        else 
        { 
            // als de input field niet empty is dan voer je de ingevulde gegevens in
            $query_b = mysqli_query($conn, "INSERT INTO bestemming (plaats, land, provincie) 
            VALUES ('$bstm_plaats', '$land', '$provincie')") or die (mysqli_error($conn));
            if ($query_b) 
            {
                header("Location: ../ADMIN/bestemming.admin.php?succes");
                echo "Succes";
                exit(0);   
            } else 
            {
                header("Location: ../ADMIN/bestemming.admin.php?no-succes");
                echo "Fail";
                exit(0);
            }
        }   
    }   
// end Input

// Input Accommodatie
    // kijken of de knop ingedrukt wordt 
    if(isset($_POST['submit_accommodatie']))
    {
        // kijken of de input field empty is
        if(!empty($_POST['fac_checkbox'])) 
        {
            // het initialiseren van variabelen en die een value geven
            $checkbox_impl = implode(", ", $_POST['fac_checkbox']);
            $get_bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);
            $soort = mysqli_real_escape_string($conn, $_POST['soort']);
            $kamer = mysqli_real_escape_string($conn, $_POST['kamer']);
            $ligging = mysqli_real_escape_string($conn, $_POST['ligging']);
            // hier initialiseer ik de gegevens voor de images in een array
            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            // dit is gewoon een extra check voor de zekerheid
            if($error === 0) 
            {
                if($img_size > 1000000)
                {
                    header('Location: ../ADMIN/accommodatie.admin.php?FILE TO LARGE');
                    exit(0);
                } else 
                {
                    // hier convert ik de image gegevens en laat ik bepaalde image types toe
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg", "jpeg", "png");
                    
                    // dan check ik of de values bestaan in de array 
                    if(in_array($img_ex_lc, $allowed_exs)) 
                    {
                        // zo ja dan geef ik elk img een uniek id en upload ik de images naar een file die
                        // alle images behoud
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = '../UPLOAD-IMG/'.$new_img_name;
                        move_uploaded_file($img_tmp, $img_upload_path);
                        
                        // kijken of de input field empty is
                        if(empty($get_bstmID) || empty($soort) || empty($kamer) || empty($ligging) || empty($new_img_name)) 
                        {
                            header('Location: ../ADMIN/accommodatie.admin.php?EMPTY FIELDS');
                            exit(0);
                        } 
                        else 
                        {
                            // als de input field niet empty is dan voer je de ingevulde gegevens in
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


// Update Reis
    // kijken of de knop ingedrukt wordt 
    if(isset($_POST['reis_update'])) 
    {
        // het initialiseren van variabelen en die een value geven
        $get_reis_id = mysqli_real_escape_string($conn, $_POST['id_reis']);
        $bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);
        $type = mysqli_real_escape_string($conn, $_POST['reis_type']);
        $depID = mysqli_real_escape_string($conn, $_POST['vertrek']);

        $r_periode = mysqli_real_escape_string($conn, $_POST['periode']);
        $r_check = mysqli_real_escape_string($conn, $_POST['check_in']);
        $vtrk_date = mysqli_real_escape_string($conn, $_POST['vertrek_date']);
        $r_nr = mysqli_real_escape_string($conn, $_POST['reis_nummer']);
        $r_prijs = mysqli_real_escape_string($conn, $_POST['prijs']);

        // kijken of de input field empty is
        if(empty($bstmID) || empty($type) || empty($depID) || empty($r_periode) || empty($r_check) 
        || empty($vtrk_date) || empty($r_nr) || empty($r_prijs)) 
        {
            header("Location: ../ADMIN/reizen.admin.php?EMPTY-FIELDS");
            exit(0);
        } else 
        { 
            // als de input field niet empty is dan update je de ingevulde gegevens
            $update_query_reis = mysqli_query($conn, "UPDATE reis 
            SET bestemming = '$bstmID', periode = '$r_periode', naam_type = '$type', depID = '$depID', 
            check_in = '$r_check', vertrek_date = '$vtrk_date', reis_nr = '$r_nr', prijs = '$r_prijs' 
            WHERE idReis = '$get_reis_id'");
            if ($update_query_reis) 
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

// end Update

// Update Bestemming
    // kijken of de knop ingedrukt wordt
    if(isset($_POST['bstm_update'])) 
    {
        // het initialiseren van variabelen en die een value geven
        $get_bstm_id = mysqli_real_escape_string($conn, $_POST['id_bestemming']);
        $upd_plaats_bstm = mysqli_real_escape_string($conn, $_POST['plaats']);
        $upd_land_bstm = mysqli_real_escape_string($conn, $_POST['land']);
        $upd_provincie_bstm = mysqli_real_escape_string($conn, $_POST['provincie']);

        // kijken of de input field empty is
        if(empty($upd_land_bstm) || empty($upd_land_bstm) || empty($upd_provincie_bstm)) 
        {
            header('Location: ../ADMIN/bestemming.admin.php?EMPTY!!');
            exit(0);
        } else 
        {
            // als de input field niet empty is dan update je de ingevulde gegevens
            $update_query_bstm = mysqli_query($conn, "UPDATE bestemming SET plaats = '$upd_plaats_bstm', 
            land = '$upd_land_bstm', provincie = '$upd_provincie_bstm' WHERE idBestemming = '$get_bstm_id'");

            if($update_query_bstm)
            {
                header('Location: ../ADMIN/bestemming.admin.php?UPDATE SUCCES');
                exit(0);
            } else 
            {
                header('Location: ../ADMIN/bestemming.admin.php?UPDATE FAIL');
                exit(0);
            }
        }


    }

// end Update

// Update Accommodatie
    // kijken of de knop ingedrukt wordt 
    if(isset($_POST['acco_update']))
    {
        // kijken of de input field empty is
        if(!empty($_POST['fac_checkbox'])) 
        {
            // dan herhaal ik eigenlijk wat ik bij de het invoegen van de images heb gedaan
            $checkbox_impl = implode(", ", $_POST['fac_checkbox']);
            $get_accoID = mysqli_real_escape_string($conn, $_POST['id_acco']);
            $get_bstmID = mysqli_real_escape_string($conn, $_POST['bestemming']);

            $acco = mysqli_real_escape_string($conn, $_POST['soort']);
            $kamer = mysqli_real_escape_string($conn, $_POST['kamer']);
            $ligging = mysqli_real_escape_string($conn, $_POST['ligging']);

            // hier herhaal ik het ook
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
                        
                        // kijken of de input field empty is
                        if(empty($get_bstmID) || empty($acco) || empty($kamer) || empty($ligging) || empty($new_img_name)) 
                        {
                            header('Location: ../ADMIN/accommodatie.admin.php?EMPTY FIELDS');
                            exit(0);
                        } 
                        else 
                        {
                            // als de input field niet empty is dan update je de ingevulde gegevens
                            $sql_update = mysqli_query($conn, "UPDATE accommodatie 
                            SET bstmID = '$get_bstmID ', soort = '$acco', kamer = '$kamer', ligging = '$ligging', 
                            faciliteit = '$checkbox_impl', picture = '$new_img_name' 
                            WHERE idAcco = '$get_accoID'");
        
                            if($sql_update)
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


















    
// end Update


// Delete Reis
    // kijken of de knop ingedrukt wordt 
    if(isset($_POST['delete_reis'])) 
    {
        //  hier zet ik de id van de reis in een variable 
        $id_reis = mysqli_real_escape_string($conn, $_POST['hidden_v_reis']);
        // en delete elk id van de reis die gelijk is aan de variable waar de id van de reis inzit
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
    // hier gebeurt hetzelfde als bij het verwijderen van de reis
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

            $sql_delete_type = mysqli_query($conn, "DELETE FROM reistype WHERE idType = '$id_type'");
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