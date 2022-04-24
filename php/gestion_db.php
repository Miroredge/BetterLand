<?php
    require_once("db.php");
    require_once("utils.php");
    if(!isset($_SESSION)) session_start();

    function check_specials_chars($string)
    {
        $specials_chars = array("'", "\"", "\\", "/", "`", "~", "!", "$", "%", "^", "&", "*", "(", ")", "=", "|", "\\", "?", ">", "<", ";", ":");
        $string = str_replace($specials_chars, "", $string);
        return $string;
    }

    function check_value_global_tables($table, $column, $value)
    {
        $table_formatted = mb_convert_case($table, MB_CASE_LOWER, "UTF-8");

        $conn = $GLOBALS['connection'];
        $sql = "SELECT * FROM `" . $table_formatted . "` WHERE " . $column . " = '". $value . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            if ($result -> num_rows > 0)
            {   
                mysqli_free_result($result);
                return false;
            }
            else
            {
                mysqli_free_result($result);
                return true;
            }
        }
    }

    function get_value_global_tables($table, $value_needed, $column, $value)
    {
        $table_formatted = mb_convert_case($table, MB_CASE_LOWER, "UTF-8");

        $conn = $GLOBALS['connection'];
        $sql = "SELECT `" . $value_needed . "` FROM `" . $table_formatted . "` WHERE " . $column . " = '". $value . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("(GVGT) Veuillez Contacter l'administrateur");
        }
        else
        {
            if ($result -> num_rows > 0)
            {   
                $row = $result -> fetch_assoc();
                mysqli_free_result($result);
                return $row[$value_needed];
            }
            else
            {
                mysqli_free_result($result);
                return false;
            }
        }
    }

    function update_row_global_tables($table, $column, $value, $where_column, $where_value)
    {
        $table_formatted = mb_convert_case($table, MB_CASE_LOWER, "UTF-8");

        $conn = $GLOBALS['connection'];
        $sql = "UPDATE `" . $table_formatted . "` SET " . $column . " = '" . $value . "' WHERE " . $where_column . " = '" . $where_value . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            $_SESSION["info_updated"] = "Les Informations ont été mises à jour";
        }
    }

    function delete_row_global_tables($table, $column, $value)
    {
        $table_formatted = mb_convert_case($table, MB_CASE_LOWER, "UTF-8");

        $conn = $GLOBALS['connection'];
        $sql = "DELETE FROM `" . $table_formatted . "` WHERE " . $column . " = '" . $value . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit(mysqli_error($conn));
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            $_SESSION["info"] = "La Ligne  où ROW_IDT = '" . $value . "' et appartenant à la table = '" . $table . "' a bien été supprimée de la base de données";
        }
    }

    function check_hierarchy_access($rol_name, $roles)
    {
        $is_access = false;

        $conn = $GLOBALS['connection'];

        $sql = "SELECT RGT FROM `rol` WHERE nam = '" . $rol_name . "';";
        $result_rol_hierarchy = $conn -> query($sql);

        
        $sql = "SELECT MIN(RGT) AS RGT FROM `rol` WHERE NAM IN ('" . $roles ."');";
        $result_user_hierarchy = $conn -> query($sql);

        // TEST exit(var_dump($result_rol_hierarchy -> fetch_assoc()) . " " . var_dump($result_user_hierarchy -> fetch_assoc()) . " " . var_dump($roles));

        if ($result_rol_hierarchy === false OR $result_user_hierarchy === false) 
        {   
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {   
            $is_access = false;
            if (($result_user_hierarchy -> fetch_assoc()) <= ($result_rol_hierarchy -> fetch_assoc()))
            {
                $is_access = true;
            }
            
            return $is_access;
        }
        
    }

    function verif_role($rol) 
    {
        $is_role = false;
        $is_role = check_hierarchy_access($rol, implode("','", $_SESSION["roles"]));
        return $is_role;

    }

    function add_user($post)
    {
        $conn = $GLOBALS['connection'];

        $psd = check_specials_chars($post['pseudo']);
        $fst_nam = mb_convert_case($post['firstname'], MB_CASE_TITLE, "UTF-8");
        $lst_nam = mb_convert_case($post['lastname'], MB_CASE_UPPER, "UTF-8");
        $sex = $post['sexe'];
        $eml = check_specials_chars($post['email']);
        $adr = mb_convert_case(check_specials_chars($post['adresse']), MB_CASE_TITLE, "UTF-8");;
        $cty = mb_convert_case($post['ville'], MB_CASE_TITLE, "UTF-8");
        $pst_cod = $post['cp'];
        $phn_nbr = $post['telephone'];
        $bth_dat = $post['birthday'];
        $tmp_pwd = 0;

        if(check_value_global_tables('usr', 'psd', $psd) === true AND check_value_global_tables('usr', 'eml', $eml) === true)
        {   
            if (check_password($post['password'])) 
            {
                $pwd = hash("sha256", $post['password']);

                $query = $conn -> prepare ("INSERT INTO `usr` (PSD, FST_NAM, LST_NAM, SEX, EML, ADR, CTY, PST_COD, PHN_NBR, BTH_DAT, PWD, TMP_PWD) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $query -> bind_param('sssssssisssi', $psd, $fst_nam, $lst_nam, $sex, $eml, $adr, $cty, $pst_cod, $phn_nbr, $bth_dat, $pwd, $tmp_pwd);
                $query -> execute();

                $last_row_idt = $conn -> insert_id;

                $sql = "INSERT INTO `rol_usr_lnk` (ROL_ROW_IDT, USR_ROW_IDT) (SELECT ROW_IDT, '" . $last_row_idt . "' FROM `rol` WHERE NAM = 'User');";
                $conn -> query($sql);
                
                
                $_SESSION['pseudo'] = $psd;
                $_SESSION['roles'] = array("User");

                $_SESSION["info"] = "Vous êtes bien inscrit et avez été connecté(e).";
                header("Location:/index.php");
            }
        }
        else
        {
            $_SESSION["error"] = "Ce pseudo ou cette adresse mail existe déjà";
        }
    }

    function check_available_cart($user_psd)
    {
        $conn = $GLOBALS['connection'];

        $user_id = get_value_global_tables('USR', 'ROW_IDT', 'PSD', $user_psd);

        $sql = "SELECT COUNT(*) AS COUNT FROM `crt` WHERE DAT IS NULL AND ROW_IDT_USR = '" . $user_id . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            $row = $result -> fetch_assoc();

            if ($row['COUNT'] > 1) 
            {
                exit("Veuillez Contacter l'administrateur");
            }
            else
            {
                if ($row['COUNT'] == 1)
                {
                    return true;
                }
                else
                {
                    return false;
                }    
            }
        }
    }

    function get_available_cart($user_psd)
    {
        $r_return = null;

        $conn = $GLOBALS['connection'];

        $user_id = get_value_global_tables('USR', 'ROW_IDT', 'PSD', $user_psd);

        $cart_available = check_available_cart($user_psd);

        if($cart_available === true)
        {
            $sql = "SELECT ROW_IDT ID FROM `crt` WHERE DAT IS NULL AND ROW_IDT_USR = '" . $user_id . "';";
            $result = $conn -> query($sql);

            if ($result === false)
            {
                exit("Veuillez Contacter l'Administrateur");
            }
            else
            {
                $row = $result -> fetch_assoc();
                $idt_crt = $row['ID'];
                
                $r_return = $idt_crt;
            }
        }
        else
        {
            $sql = "INSERT INTO `crt` (DAT, ROW_IDT_USR) VALUES (NULL, '" . $user_id . "');";
            $result = $conn -> query($sql);
            
            if($result === false)
            {
                exit("Veuillez Contacter l'Administrateur");
            }
            else
            {
                $last_row_idt = $conn -> insert_id;

                $r_return = $last_row_idt;
            }
        }
        return $r_return;
    }

    function add_product_to_cart($user_psd, $product_id, $quantity)
    {
        $cart_id = get_available_cart($user_psd);

        $conn = $GLOBALS['connection'];
        
        $sql = "INSERT INTO `crt_pdt_lnk` (QTY, CRT_ROW_IDT, PDT_ROW_IDT) VALUES ('" . $quantity . "', '" . $cart_id . "', '" . $product_id . "') ON DUPLICATE KEY UPDATE QTY = QTY + '" . $quantity . "';";
        $result = $conn -> query($sql);

        if($result === false)
        {
            exit("Veuillez Contacter l'Administrateur");
        }
        else 
        {
            return true;   
        }
    }

    function remove_from_cart($user_psd, $product_id)
    {
        $cart_id = get_available_cart($user_psd);

        $conn = $GLOBALS['connection'];
        
        $sql = "DELETE FROM `crt_pdt_lnk` WHERE CRT_ROW_IDT = '" . $cart_id . "' AND PDT_ROW_IDT = '" . $product_id . "';";
        $result = $conn -> query($sql);

        if($result === false)
        {
            exit("Veuillez Contacter l'Administrateur");
        }
        else 
        {
            return true;   
        }
    }

    function user_delivery_address_exist($user_id)
    {
        $exists = true;

        $conn = $GLOBALS['connection'];

        $sql = "SELECT ADR ADRESSE, CTY VILLE, PST_COD CP FROM `USR` WHERE ROW_IDT = '" . $user_id . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'Administrateur");
        }
        else
        {
            foreach ($result as $key => $value) 
            {
                 
                if ($value['ADRESSE'] == '' or $value['VILLE'] == '' or $value['CP'] == '') 
                {
                    $exists = false;
                }
            }
            return $exists;
        }
    }

    function validate_user_cart($user_id)
    {
        $conn = $GLOBALS['connection'];
 
        $sql = "UPDATE `crt` SET DAT = NOW() WHERE DAT IS NULL AND ROW_IDT_USR = '" . $user_id . "';";
        $result = $conn -> query($sql);

        if($result === false)
        {
            exit("Veuillez Contacter l'Administrateur");
        }
        else 
        {
            return true;   
        }
    }

    function get_products_in_cart($user_psd)
    {
        $conn = $GLOBALS['connection'];

        $cart_id = get_available_cart($user_psd);

        $sql = "SELECT `PDT`.ROW_IDT ID, `PDT`.NAM Nom, PCE 'Prix Unitaire', QTY Quantité, QTY*`pdt`.PCE Somme FROM `crt_pdt_lnk` INNER JOIN `pdt` ON (PDT_ROW_IDT = `PDT`.ROW_IDT) WHERE CRT_ROW_IDT = '" . $cart_id . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'Administrateur");
        }
        else
        {
            $values = array();

            foreach ($result as $row) 
            {
                $values[] = $row;
            }

            if (empty($values)) 
            {
                return false;
            }
            else
            {
                return $result;
            }

        }
    }

    function get_amount_in_user_cart($user_id)
    {
        $conn = $GLOBALS['connection'];

        $user_psd = get_value_global_tables('USR', 'PSD', 'ROW_IDT', $user_id);
        $cart_id = get_available_cart($user_psd);

        $sql = "SELECT SUM(QTY*`pdt`.PCE) Total FROM `crt_pdt_lnk` INNER JOIN `pdt` ON (PDT_ROW_IDT = `PDT`.ROW_IDT) WHERE CRT_ROW_IDT = '" . $cart_id . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'Administrateur");
        }
        else
        {
            $row = $result -> fetch_assoc();

            return $row['Total'];
        }
    }

    function delete_user($user, $inadmin = 0) 
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT COUNT(*) FROM `rol_usr_lnk` INNER JOIN `usr` ON `rol_usr_lnk`.USR_ROW_IDT = `usr`.ROW_IDT INNER JOIN `rol` ON `rol_usr_lnk`.ROL_ROW_IDT = `rol`.ROW_IDT WHERE `usr`.PSD = '" . $user . "' AND `rol`.NAM = 'SuperAdmin';";
        $result_count = $conn -> query($sql);

        if (implode(',', ($result_count -> fetch_assoc())) == 0) 
        {
            $sql = "DELETE FROM `usr` WHERE psd = '". $user . "';";
            $result = $conn -> query($sql);

            if ($result === false)
            {   
                exit("Veuillez Contacter l'administrateur");
            }
            else
            {
                if ($inadmin == 1) 
                {}
                else
                {
                    include("logout.php");

                    session_start();
                    $_SESSION["info"] = "L'utilisateur '" . $user . "' a bien été supprimé";

                    header("Location:/index.php");
                }
            }
        }
        else 
        {
            $sql = "SELECT COUNT(*) FROM `rol_usr_lnk` WHERE ROL_ROW_IDT = (SELECT ROW_IDT FROM `rol` WHERE NAM = 'SuperAdmin');";
            $result_count = $conn -> query($sql);

            if (implode(',', ($result_count -> fetch_assoc())) >= 2) 
            {
                $sql = "DELETE FROM `usr` WHERE psd = '". $user . "';";
                $result = $conn -> query($sql);

                if ($result === false)  
                {   
                    exit("Veuillez Contacter l'administrateur");
                }
                else
                {
                    if ($inadmin == 1)
                    {}
                    else
                    {
                        include("logout.php");

                        session_start();
                        $_SESSION["info"] = "L'utilisateur '" . $user . "' a bien été supprimé";

                        header("Location:/index.php");
                    }
                }
            }
            else
            {
                $_SESSION["info_updated"] = "Vous ne pouvez pas supprimer votre compte, vous êtes le seul SuperAdmin";
                header("Location:../php/profil.php");
            }
        }
    }

    function login_user($post) 
    {
        $conn = $GLOBALS['connection'];

        $eml = check_specials_chars($post['email']);
        $pwd = hash("sha256", $post['password']);

        $sql = "SELECT PSD, GROUP_CONCAT(rol.NAM), TMP_PWD FROM `usr` INNER JOIN `rol_usr_lnk` ON (usr.ROW_IDT = USR_ROW_IDT) INNER JOIN `rol` ON (ROL_ROW_IDT = rol.ROW_IDT)  WHERE eml = '" . $eml . "' AND pwd = '" . $pwd . "';";
        $result = $conn -> query($sql);
        
        $row = $result -> fetch_row();

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            if (($row[0] != null) && ($row[1] != null) && ($row[2] != null)) 
            {
                if(!isset($_SESSION)) session_start();

                $psd = $row[0];

                $_SESSION['pseudo'] = $row[0];

                $_SESSION['roles'] = explode(',', $row[1]);

                if ($row[2] == 1)
                {
                    header("Location:/php/temporary_change_password.php");
                }
                else
                {
                    $_SESSION["info"] = "Vous ('" . $psd . "') êtes bien connecté(e).";
                    header("Location:/index.php");
                }
            }
            else
            {
                $_SESSION["error"] = "Cette adresse mail n'existe pas ou le mot de passe est incorrect";
            }
        }
    }

    function change_password($pseudo, $password) 
    {
        $conn = $GLOBALS['connection'];

        if ((strlen($password) == 36) or check_password($password))
        {
            $pwd = hash("sha256", $password);

            $sql = "UPDATE usr SET pwd = '" . $pwd . "', TMP_PWD = 0 WHERE psd = '" . $pseudo . "';";
            $result = $conn -> query($sql);
            if ($result === false) 
            {
                exit("Veuillez Contacter l'administrateur");
            }
            else
            {
                $_SESSION["info"] = "Le mot de passe a bien été modifié";
            }
        }
    }

    function recover_password($email, $birthdate) 
    {
        $conn = $GLOBALS['connection'];

        
        $sql = "SELECT COUNT(*) FROM `usr` WHERE eml = '" . $email . "' AND bth_dat = '" . $birthdate . "';";
        $result_count = $conn -> query($sql);

        if ($result_count === false) 
        {
            exit("Veuillez Contacter l'administrateur (0)");
        }
        else
        {
            $sql = "SELECT PSD FROM `usr` WHERE eml = '" . $email . "' AND bth_dat = '" . $birthdate . "';";
            $result = $conn -> query($sql);

            if ($result === false) 
            {
                exit("Veuillez Contacter l'administrateur (1)");
            }
            else
            {
                if (implode(',', ($result_count -> fetch_assoc())) == 1) 
                {   
                    $row = $result -> fetch_row();

                    $uuidkey = gen_uuid();
                    
                    change_password($row[0], $uuidkey);                    
                    
                    $sql = "UPDATE `usr` SET `TMP_PWD` = 1 WHERE `PSD` = '" . $row[0] . "';";
                    $result2 = $conn -> query($sql);

                    if ($result2 === false) 
                    {
                        exit("Veuillez Contacter l'administrateur (3)");
                    }
                    else
                    {
                        send_mail($email, $uuidkey, 'Mot de passe oublié');
                    }
                }
                else
                {
                    $_SESSION["error"] = "Cette adresse mail ou cette date de naissance n'existe pas";
                }
            }
        }
    }

    function get_modified_user_infos($post)
    {
        $to_modify = array();

        foreach ($post as $key => $value)
        {
            if ($value != '')
            {
                $to_modify[$key] = $value;
            }
        }
        return $to_modify;
    }

    function modify_user_infos($array)
    {
        foreach ($array as $key => $value)
        {   
            if ($key == 'firstname')
            {
                $fst_nam = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
                update_row_global_tables('usr', 'fst_nam', $fst_nam, 'psd', $_SESSION['pseudo']);
            }
            if ($key == 'lastname')
            {
                $lst_nam = mb_convert_case($value, MB_CASE_UPPER, "UTF-8");
                update_row_global_tables('usr', 'lst_nam', $lst_nam, 'psd', $_SESSION['pseudo']);
            }
            if ($key == 'email')
            {
                $eml = check_specials_chars($value);
                if (check_value_global_tables('usr', 'eml', $eml) === true) 
                {
                    update_row_global_tables('usr', 'eml', $eml, 'psd',  $_SESSION['pseudo']);
                }
                else
                {
                    $_SESSION["error"] = "Cette adresse mail existe déjà";
                    header("Location:/php/modify_user_info.php");
                }                

            }
            if ($key == 'adresse')
            {
                $adr = mb_convert_case(check_specials_chars($value), MB_CASE_TITLE, "UTF-8");
                update_row_global_tables('usr', 'adr', $adr, 'psd',  $_SESSION['pseudo']);
            }
            if ($key == 'ville')
            {
                $cty = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
                update_row_global_tables('usr', 'cty', $cty, 'psd',  $_SESSION['pseudo']);
            }
            if ($key == 'sexe')
            {
                $sex = $value;
                update_row_global_tables('usr', 'sex', $sex, 'psd', $_SESSION['pseudo']);
            }
            if ($key == 'cp')
            {
                $pst_cod = $value;
                update_row_global_tables('usr', 'pst_cod', $pst_cod, 'psd', $_SESSION['pseudo']);
            }
            if ($key == 'telephone')
            {
                $phn_nbr = $value;
                update_row_global_tables('usr', 'phn_nbr', $phn_nbr, 'psd', $_SESSION['pseudo']);
            }
            if ($key == 'birthday')
            {
                $bth_dat = $value;
                update_row_global_tables('usr', 'bth_dat', $bth_dat, 'psd', $_SESSION['pseudo']);
            }
        }
        return true;
    }

    function get_user_infos($pseudo) 
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT PSD pseudo, FST_NAM firstname, LST_NAM lastname, SEX sex, EML email, ADR address, CTY city, PST_COD postal_code, PHN_NBR phone_number, BTH_DAT birthdate FROM `usr` WHERE psd = '". $pseudo . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $row = $result -> fetch_assoc();
            return $row;
        }
    }

    function get_user_pseudo($row_idt) 
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT PSD FROM `usr` WHERE ROW_IDT = '" . $row_idt . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $row = $result -> fetch_assoc();
            return $row['PSD'];
        }
    }

    function get_user_roles($user_psd)
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT GROUP_CONCAT(rol.NAM) Roles FROM `usr` INNER JOIN `rol_usr_lnk` ON (usr.ROW_IDT = USR_ROW_IDT) INNER JOIN `rol` ON (ROL_ROW_IDT = rol.ROW_IDT) WHERE usr.PSD = '" . $user_psd . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $row = $result -> fetch_assoc();
            return explode(',', $row['Roles']);
        }
    }

    function get_roles_name($row_idt)
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT NAM FROM `rol` WHERE ROW_IDT = '" . $row_idt . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $row = $result -> fetch_assoc();
            return $row['NAM'];
        }
    }

    function get_cats_name($row_idt)
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT NAM Nom FROM `cat` WHERE ROW_IDT = '" . $row_idt . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $row = $result -> fetch_assoc();
            return $row['Nom'];
        }
    }

    function get_main_cats_name($row_idt)
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT NAM Nom FROM `pry_cat` WHERE ROW_IDT = '" . $row_idt . "';";
        $result = $conn -> query($sql);

        if ($result === false)
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $row = $result -> fetch_assoc();
            return $row['Nom'];
        }
    }

    function get_products_name($row_idt)
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT NAM Nom FROM `pdt` WHERE ROW_IDT = '" . $row_idt . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $row = $result -> fetch_assoc();
            return $row['Nom'];
        }
    }

    function get_parent_categories()
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT ROW_IDT ID, NAM Nom FROM `pry_cat`;";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {            
            $main_cats = array();

            while ($row = $result -> fetch_assoc()) 
            {
                $main_cats[] = $row;
            }
            return $main_cats;
        }
    }

    function get_child_categories($primary_cat) 
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT `CAT`.ROW_IDT ID, `PRY_CAT`.ROW_IDT P_ID, `CAT`.NAM Nom FROM `CAT` INNER JOIN `PRY_CAT` ON `CAT`.ROW_IDT_PRY_CAT = `PRY_CAT`.ROW_IDT WHERE `PRY_CAT`.NAM = '" . $primary_cat . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            $categories = array();
            
            while ($row = $result -> fetch_assoc()) 
            {
                $categories[] = $row;
            }
            return $categories;
        }
    }

    function get_products_from_cat($cat) 
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT `PDT`.ROW_IDT ID, `CAT`.ROW_IDT C_ID, `PRY_CAT`.ROW_IDT PC_ID, `PDT`.NAM Nom, `PDT`.PCE Prix, `PDT`.NAM FROM `PDT` INNER JOIN `CAT` ON (`PDT`.ROW_IDT_CAT = `CAT`.ROW_IDT) INNER JOIN `PRY_CAT` ON (`CAT`.ROW_IDT_PRY_CAT = `PRY_CAT`.ROW_IDT) WHERE `CAT`.NAM = '" . $cat . "';";
        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            $products = array();
            
            while ($row = $result -> fetch_assoc()) 
            {
                $products[] = $row;
            }
            return $products;
        }
    }

    function get_search_result($query_str)
    {
        $conn = $GLOBALS['connection'];

        $str_splitted = explode(' ', mb_convert_case($query_str, MB_CASE_LOWER));
        $str_without_double = array_unique($str_splitted);

        $sql = "SELECT DISTINCT `PDT`.ROW_IDT ID, `CAT`.ROW_IDT C_ID, `PRY_CAT`.ROW_IDT PC_ID, `PDT`.NAM Nom, `PDT`.PCE Prix FROM `PDT` INNER JOIN `CAT` ON (`PDT`.ROW_IDT_CAT = `CAT`.ROW_IDT) INNER JOIN `PRY_CAT` ON (`CAT`.ROW_IDT_PRY_CAT = `PRY_CAT`.ROW_IDT) WHERE ";

        foreach($str_without_double as $word)
        {
            $sql .= "((LOWER(`PDT`.NAM) LIKE '%" . $word ."%') OR (LOWER(`PDT`.DSC) LIKE '%" . $word ."%')) AND ";
        }

        $sql = substr($sql, 0, -5);
        $sql .= ";";

        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            $products = array();
            
            while ($row = $result -> fetch_assoc()) 
            {
                $products[] = $row;
            }
            return $products;
        }
    }

    function display_header () 
    {
        display_parent_categories(get_parent_categories());
    }

    function display_footer ()
    {
       display_parent_cat_footer(get_parent_categories());
    }
    
    function display_parent_cat_footer ($array)
    {
        foreach ($array as $key => $value) 
        {
            $nom = mb_convert_case($value['Nom'], MB_CASE_TITLE, "UTF-8");

            echo '<h4><a href="/php/display.php?p_cat=' . $value['ID'] . '">' . $nom . '</a></h4>';
            display_child_footer(get_child_categories($value['Nom']), $value['ID']);
        }
    }

    function display_child_footer ($array, $p_cat_id)
    {
        echo '<p>';
        foreach ($array as $key => $value) 
        {
            $nom = mb_convert_case($value['Nom'], MB_CASE_TITLE, "UTF-8");


            if ((count($array) - 1) == $key) 
            {
                echo '<a href="/php/display.php?p_cat=' . $p_cat_id . '&cat=' . $value['ID'] . '">' . str_replace("_", " ", $nom) . '</a>';
            }
            else
            {
                echo '<a href="/php/display.php?p_cat=' . $p_cat_id . '&cat=' . $value['ID'] . '">' . str_replace("_", " ", $nom) . '</a> - ';
            }
        }
        echo '</p>';
    }

    function display_parent_categories_index($array)
    {
        foreach ($array as $key => $value) 
        {
            echo '<div class="article-product">';
            echo '<a class="object" href=/php/display.php?p_cat='. $value['ID'] . ">" . mb_convert_case(str_replace("_", " ", $value['Nom']), MB_CASE_TITLE, "UTF-8") . '</a>';
            echo '</div>';
        }
    }

    function display_child_index($array)
    {
        if (!empty($array)) 
        {
            foreach ($array as $key => $value) 
            {
                echo '<div class="article-product">';
                echo '<a class="object" href=/php/display.php?p_cat='. $value['P_ID'] . "&cat=" . $value['ID'] . ">" . mb_convert_case(str_replace("_", " ", $value['Nom']), MB_CASE_TITLE, "UTF-8") . '</a>';
                echo '</div>';
            }
        }
        else
        {
            echo '<h2>Aucune sous-catégorie trouvée</h2>';
        }
    }

    function display_products($array, $obj="") 
    {
        if (!empty($array)) 
        {
            foreach ($array as $key => $value) 
            {
                echo '<div class=miniature-produit>';
                    echo '<a href="/php/display.php?p_cat='. $value['PC_ID'] . "&cat=" . $value['C_ID'] . "&pdt=" . $value['ID'] . '"><img src="' . get_value_global_tables('PDT', 'IMG', 'ROW_IDT', $value['ID']) . '" width=100%/></a>';
                    echo '<a href="/php/display.php?p_cat='. $value['PC_ID'] . "&cat=" . $value['C_ID'] . "&pdt=" . $value['ID'] . '">' . $value['Nom'] . '</a> <p>' . $value['Prix'] . ' € </p>';
                echo '</div>';
            }
        }
        else
        {
            $obj = mb_convert_case(str_replace("_", " ", $obj), MB_CASE_TITLE, "UTF-8") . ' :';

            echo '<div class=miniature-produit>';
                echo '<a href="/php/rickRolled.php"><img src="https://media.istockphoto.com/vectors/lost-items-line-vector-icon-unidentified-items-outline-isolated-icon-vector-id1271880340?k=20&m=1271880340&s=612x612&w=0&h=2uNB7AtHZiJOYHqCwQ_QeJnWhHwJEPtpNrNHqjaakuw=" width=100%/></a>';
                echo '<a>' . $obj . ' Aucun produit trouvé</a>';
            echo '</div>';
        }
    }

    function display_parent_categories($array)
    {
        foreach ($array as $key => $value) 
        {
            echo "<li>";
            echo "<div id='title-cat'>";
            echo '<a class="fill-div" href="/php/display.php?p_cat=' . $value['ID'] . '">' . mb_convert_case(str_replace("_", " ", $value['Nom']), MB_CASE_TITLE, "UTF-8") . '</a>';
            echo "</div>";
            display_child_header(get_child_categories($value['Nom']));
            echo "</li>";
        }
        // type : <a class="fill-div" href="/papetrie/">Papeterie</a>
        
    }
    
    function display_child_header ($array)
    {
        echo '<div class="contenu-deroullant">';
        foreach ($array as $key => $value) 
        {
            echo '<a href=/php/display.php?p_cat='. $value['P_ID'] . "&cat=" . $value['ID'] . ">" . mb_convert_case(str_replace("_", " ", $value['Nom']), MB_CASE_TITLE, "UTF-8") . '</a>';
        }
        echo '</div>';
        // type : <a href="/fournitures/trousses/">Trousses</a>
    }

    function display_user_table_cart ($data)
    {
        $data -> data_seek(0);

        $first = true;
        
        echo '<table border=1>';

        while ($row = $data->fetch_assoc())
        {
            if ($first)
            {
                $first = false;
                echo '<tr>';
                foreach ($row as $key => $value)
                {
                    if($key != 'ID')
                    echo "<th> {$key} </th>";
                }
                echo '<th> Supprimer </th>';
                echo '</tr>';
            }

            echo '<tr>';
            foreach ($row as $key => $value)
            {
                if($key != 'ID')
                echo "<td> {$value} </td>";       
            }
            echo '<td> <a id=s href="/php/delete_product_cart.php?id=' . $row['ID'] . '"> Supprimer </a></td>';
            echo '</tr>';		
        }
        echo'</table>';
    }

    function db_disconnect() 
    {
        $conn = $GLOBALS['connection'];
        $conn -> close();
    }
?>