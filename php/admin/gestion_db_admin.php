<?php 

    require_once("../db.php");
    require_once("../gestion_db.php");
    if(!isset($_SESSION)) session_start();


    function get_table_lists($table)
    {
        $table_formatted = mb_convert_case($table, MB_CASE_LOWER, "UTF-8");

        $conn = $GLOBALS['connection'];

        if ($table_formatted == 'users') 
        {
            $sql = "SELECT `usr`.ROW_IDT ID, PSD Pseudo, GROUP_CONCAT(rol.NAM) Rôle, FST_NAM Prénom, LST_NAM Nom, SEX Sexe, EML Email, ADR Adresse, CTY Ville, PST_COD CP, PHN_NBR Tél, BTH_DAT D_Naiss, TMP_PWD MDP_T FROM `usr` INNER JOIN `rol_usr_lnk` ON (`rol_usr_lnk`.USR_ROW_IDT = `usr`.ROW_IDT) INNER JOIN `rol` ON (`rol_usr_lnk`.ROL_ROW_IDT = `rol`.ROW_IDT) GROUP BY(`usr`.PSD) ORDER BY `usr`.ROW_IDT ASC";
        }
        if ($table_formatted == 'roles') 
        {
            $sql = "SELECT ROW_IDT ID, NAM Nom, RGT Droits FROM `rol` ORDER BY RGT DESC";
        }
        if ($table_formatted == 'primary_cats')
        {
            $sql = "SELECT ROW_IDT ID, NAM Nom FROM `pry_cat` ORDER BY ROW_IDT ASC";
        }
        if ($table_formatted == 'categories')
        {
            $sql = "SELECT `cat`.ROW_IDT ID, `cat`.NAM Nom_Cat, `pry_cat`.NAM Nom_P_Cat FROM `cat` INNER JOIN `pry_cat` ON (`cat`.ROW_IDT_PRY_CAT = `pry_cat`.ROW_IDT)";
        }
        if ($table_formatted == 'products') 
        {
            $sql = "SELECT `pdt`.ROW_IDT ID, `pdt`.NAM Nom, `pdt`.PCE Prix, `cat`.NAM Nom_Cat, `pry_cat`.NAM Nom_P_Cat, `pdt`.IMG Image, `pdt`.DSC Description FROM `pdt` INNER JOIN `cat` ON (`pdt`.ROW_IDT_CAT = `cat`.ROW_IDT) INNER JOIN `pry_cat` ON (`cat`.ROW_IDT_PRY_CAT = `pry_cat`.ROW_IDT)";
        }

        $result = $conn -> query($sql);

        if ($result === false) 
        {
            exit("Veuillez Contacter l'administrateur");
        }
        else
        {
            return $result;
        }
    }

    function delete_by_admin ($table, $id) 
    {
        $conn = $GLOBALS['connection'];

        if ($table == 'users') 
        {
            $psd = get_user_pseudo($id);

            if ($psd == $_SESSION['pseudo']) 
            {
                $_SESSION['info'] = "Action Impossible : Vous ne pouvez pas vous supprimer !";
                header("Location:/php/admin/display.php?table=" . $table);
                exit();
            }
            else
            {
                delete_user($psd, 1);
                $_SESSION['info'] = "Utilisateur Supprimé | pseudo = " . $psd . ", id = " . $id . "";
                header("Location:/php/admin/display.php?table=" . $table);
                exit();
            }
        }

        if ($table == 'roles') 
        {
            if(in_array(get_value_global_tables('rol', 'NAM', 'ROW_IDT', $id), array('SuperAdmin', 'Admin', 'User')))
            {
                $_SESSION['info'] = "Action Impossible : Vous ne pouvez pas supprimer les rôles primaires !";
                header("Location:/php/admin/display.php?table=" . $table);
                exit();
            }
            else
            {
                $rol_name = get_value_global_tables('rol', 'NAM', 'ROW_IDT', $id);

                delete_row_global_tables('rol', 'ROW_IDT', $id);

                $_SESSION['info'] = "Rôle Supprimé | nom = " . $rol_name . ", id = " . $id . "";
                header("Location:/php/admin/display.php?table=" . $table);
                exit();
            }
        }
        if ($table == 'primary_cats')
        {
            if(in_array(get_value_global_tables('pry_cat', 'NAM', 'ROW_IDT', $id), array('papeterie', 'fournitures', 'informatique')))
            {
                $_SESSION['info'] = "Action Impossible : Vous ne pouvez pas supprimer les catégories mères primaires !";
                header("Location:/php/admin/display.php?table=" . $table);
                exit();
            }
            else 
            {
                delete_row_global_tables('pry_cat', 'ROW_IDT', $id);    
            }
        }
        if ($table == 'categories')
        {
            delete_row_global_tables('cat', 'ROW_IDT', $id);
        }
        if ($table == 'products') 
        {
            delete_row_global_tables('pdt', 'ROW_IDT', $id);
        }

    }

    function get_modified_infos($post)
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

    function update_user($array, $user_id)
    {
        $user_psd = get_user_pseudo($user_id);

        foreach ($array as $key => $value)
        {   
            if ($key == 'firstname')
            {
                $fst_nam = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
                update_row_global_tables('usr', 'fst_nam', $fst_nam, 'psd', $user_psd);
            }
            if ($key == 'lastname')
            {
                $lst_nam = mb_convert_case($value, MB_CASE_UPPER, "UTF-8");
                update_row_global_tables('usr', 'lst_nam', $lst_nam, 'psd', $user_psd);
            }
            if ($key == 'email')
            {
                $eml = check_specials_chars($value);
                if (check_value_global_tables('usr', 'eml', $eml) === true) 
                {
                    update_row_global_tables('usr', 'eml', $eml, 'psd',  $user_psd);
                }
                else
                {
                    $_SESSION["error"] = "Cette adresse mail existe déjà";
                    header("Location:/php/admin/modify.php?table=users&id=". $user_id);
                }                

            }
            if ($key == 'adresse')
            {
                $adr = mb_convert_case(check_specials_chars($value), MB_CASE_TITLE, "UTF-8");
                update_row_global_tables('usr', 'adr', $adr, 'psd',  $user_psd);
            }
            if ($key == 'ville')
            {
                $cty = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
                update_row_global_tables('usr', 'cty', $cty, 'psd',  $user_psd);
            }
            if ($key == 'sexe')
            {
                $sex = $value;
                update_row_global_tables('usr', 'sex', $sex, 'psd', $user_psd);
            }
            if ($key == 'cp')
            {
                $pst_cod = $value;
                update_row_global_tables('usr', 'pst_cod', $pst_cod, 'psd', $user_psd);
            }
            if ($key == 'telephone')
            {
                $phn_nbr = $value;
                update_row_global_tables('usr', 'phn_nbr', $phn_nbr, 'psd', $user_psd);
            }
            if ($key == 'birthday')
            {
                $bth_dat = $value;
                update_row_global_tables('usr', 'bth_dat', $bth_dat, 'psd', $user_psd);
            }
        }
        return true;
    }

    function update_role($array, $role_id)
    {
        foreach ($array as $key => $value)
        {   
            if ($key == 'rol_name')  
            {
                $rol_name = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
                update_row_global_tables('rol', 'NAM', $rol_name, 'ROW_IDT', $role_id);
            }

            if ($key == 'rol_rights')  
            {
                update_row_global_tables('rol', 'RGT', $value, 'ROW_IDT', $role_id);
            }
        }
        return true;
    }

    function update_p_cat($array, $p_cat_id)
    {
        foreach ($array as $key => $value)
        {   
            if ($key == 'pry_cat_name')  
            {
                update_row_global_tables('pry_cat', 'NAM', $value, 'ROW_IDT', $p_cat_id);
            }
        }
        return true;
    }

    function update_cat($array, $cat_id)
    {
        foreach ($array as $key => $value)
        {
            if ($key == 'cat_name')
            {
                update_row_global_tables('cat', 'NAM', $value, 'ROW_IDT', $cat_id);
            }
            if ($key == 'name_pry_cat')  
            {
                update_row_global_tables('cat', 'ROW_IDT_PRY_CAT', $value, 'ROW_IDT', $cat_id);
            }
        }
        return true;
    }
    
    function update_product($array, $product_id)
    {
        foreach ($array as $key => $value)
        {
            if ($key == 'product_name')
            {
                update_row_global_tables('pdt', 'NAM', $value, 'ROW_IDT', $product_id);
            }
            if ($key == 'name_cat')  
            {
                update_row_global_tables('pdt', 'ROW_IDT_CAT', $value, 'ROW_IDT', $product_id);
            }
            if ($key == 'price')  
            {
                $price_translated_with_comma = str_replace(',', '.', $value);
                update_row_global_tables('pdt', 'PCE', $price_translated_with_comma, 'ROW_IDT', $product_id);
            }
            if ($key == 'image')  
            {
                update_row_global_tables('pdt', 'IMG', $value, 'ROW_IDT', $product_id);
            }
            if ($key == 'description')  
            {
                update_row_global_tables('pdt', 'DSC', $value, 'ROW_IDT', $product_id);
            }
        }
        return true;
    }

    function add_user_by_admin($post)
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
        $rol = $post['role'];
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

                $sql = "INSERT INTO `rol_usr_lnk` (ROL_ROW_IDT, USR_ROW_IDT) (SELECT ROW_IDT, '" . $last_row_idt . "' FROM `rol` WHERE NAM = '" . $rol . "');";
                $conn -> query($sql);

                $_SESSION["info"] = "L'utilisateur : " . $psd . " a bien été ajouté." ;
                header("Location:/php/admin/display.php?table=users");
            }
        }
        else
        {
            $_SESSION["error"] = "Ce pseudo ou cette adresse mail existe déjà";
        }
    }

    function add_role_by_admin($post)
    {
        $conn = $GLOBALS['connection'];

        $rol_name = mb_convert_case($post['rol_name'], MB_CASE_TITLE, "UTF-8");
        $rol_rights = $post['rol_rights'];

        if (check_value_global_tables('rol', 'nam', $rol_name) == true)
        {
            $query = $conn -> prepare("INSERT INTO `rol` (NAM, RGT) VALUES (?, ?)");
            $query -> bind_param('si', $rol_name, $rol_rights);
            $query -> execute();

            $_SESSION["info"] = "Le rôle : " . $rol_name . " a bien été ajouté." ;
            header("Location:/php/admin/display.php?table=roles");
        }
        else
        {
            $_SESSION["error"] = "Le nom de ce rôle existe déjà";
        }
        
    }

    function add_primary_by_admin($post)
    {
        $conn = $GLOBALS['connection'];

        $pry_cat_nam = $post['pry_cat_name'];

        if (check_value_global_tables('pry_cat', 'nam', $pry_cat_nam) == true)
        {
            $query = $conn -> prepare("INSERT INTO `pry_cat` (NAM) VALUES (?)");
            $query -> bind_param('s', $pry_cat_nam);
            $query -> execute();

            $_SESSION["info"] = "Le catégorie mère : " . $pry_cat_nam . " a bien été ajoutée." ;
            header("Location:/php/admin/display.php?table=primary_cats");
        }
        else
        {
            $_SESSION["error"] = "Le nom de cette catégorie mère existe déjà";
        }
    }

    function add_category_by_admin($post)
    {
        $conn = $GLOBALS['connection'];

        $cat_nam = $post['cat_name'];
        $pry_cat_id = $post['name_pry_cat'];

        if ($pry_cat_id == "")
        {
            $_SESSION["error"] = "Veuillez choisir une catégorie mère ! ";
        }
        else 
        {
            if (check_value_global_tables('cat', 'nam', $cat_nam) == true)
            {
                $query = $conn -> prepare("INSERT INTO `cat` (NAM, ROW_IDT_PRY_CAT) VALUES (?, ?)");
                $query -> bind_param('si', $cat_nam, $pry_cat_id);
                $query -> execute();
                
                $_SESSION["info"] = "La catégorie : " . $cat_nam . " a bien été ajoutée." ;
                header("Location:/php/admin/display.php?table=categories");
            }
            else
            {
                $_SESSION["error"] = "Le nom de cette catégorie existe déjà !";
            }
        }

    }

    function add_product_by_admin($post)
    {
        $conn = $GLOBALS['connection'];

        $pdt_nam = $post['product_name'];
        $cat_id = $post['name_cat'];
        $pdt_pce = $post['price'];
        $pdt_img = $post['image'];
        $pdt_des = $post['description'];

        if ($cat_id == "")
        {
            $_SESSION["error"] = "Veuillez choisir une catégorie !";
        }
        else 
        {
            if (check_value_global_tables('pdt', 'nam', $pdt_nam) == true)
            {
                $query = $conn -> prepare("INSERT INTO `pdt` (NAM, ROW_IDT_CAT, PCE, IMG, DSC) VALUES (?, ?, ?, ?, ?)");
                $query -> bind_param('siiss', $pdt_nam, $cat_id, $pdt_pce, $pdt_img, $pdt_des);
                $query -> execute();

                $_SESSION["info"] = "Le produit : " . $pdt_nam . " a bien été ajoutée." ;
                header("Location:/php/admin/display.php?table=products");
            }
            else
            {
                $_SESSION["error"] = "Le nom de ce produit existe déjà";
            }
        }
    }

    function get_primary_cats_availaible()
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT ROW_IDT ID, NAM Nom FROM `pry_cat` ORDER BY ROW_IDT ASC";
        $result = $conn -> query($sql);

        if($result == false)
        {
            exit("Veuillez contacter un administrateur.");
        }
        else 
        {
            $cats = array();
            while($row = $result -> fetch_assoc())
            {
                $cats[] = $row;
            }
            return $cats;
        }
    }

    function get_categories_availaible()
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT ROW_IDT ID, NAM Nom FROM `cat` ORDER BY ROW_IDT ASC";
        $result = $conn -> query($sql);

        if($result == false)
        {
            exit("Veuillez contacter un administrateur.");
        }
        else 
        {
            $cats = array();
            while($row = $result -> fetch_assoc())
            {
                $cats[] = $row;
            }
            return $cats;
        }
    }

    function get_products_availaible()
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT ROW_IDT ID, NAM Nom FROM `pdt` ORDER BY ROW_IDT ASC";
        $result = $conn -> query($sql);

        if($result == false)
        {
            exit("Veuillez contacter un administrateur.");
        }
        else 
        {
            $cats = array();
            while($row = $result -> fetch_assoc())
            {
                $cats[] = $row;
            }
            return $cats;
        }
    }

    function get_roles_availaible()
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT ROW_IDT ID, NAM Nom FROM `rol` ORDER BY ROW_IDT ASC";
        $result = $conn -> query($sql);

        if ($result == false)
        {
            exit("Veuillez contacter l'administrateur");
        }
        else
        {
            $roles = array();
            while ($row = $result -> fetch_assoc())
            {
                $roles[] = $row;
            }
            return $roles;
        }        
        
    }

    function get_users_availaible()
    {
        $conn = $GLOBALS['connection'];

        $sql = "SELECT ROW_IDT ID, PSD Nom FROM `usr` ORDER BY ROW_IDT ASC";
        $result = $conn -> query($sql);

        if ($result == false)
        {
            exit("Veuillez contacter l'administrateur");
        }
        else
        {
            $users = array();
            while ($row = $result -> fetch_assoc())
            {
                $users[] = $row;
            }
            return $users;
        }        
    }

    function display_roles_form($array)
    {
        foreach ($array as $key => $value) 
        {
            echo "<option value=\"" . $value['Nom'] . "\">" . $value['Nom'] . " : " . $value['ID'] . "</option>";
        }
    }

    function display_form($array)
    {
        foreach ($array as $key => $value) 
        {
            echo "<option value=\"" . $value['ID'] . "\">" . $value['Nom'] . " : " . $value['ID'] . "</option>";
        }
    }

    function display_table($name, $data)
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
                    echo "<th id='" . $key . "'> {$key} </th>";

                echo '<th>Modifier</th>';
                echo '<th>Supprimer</th>';
                echo '</tr>';      
            }
            echo '<tr class=data>';
            foreach ($row as $key => $value)
                if ($value == null OR ($value == 0 AND $key == 'Code_Postal'))
                    echo "<td class='NULL'>?</td>";
                else 
                {
                    if ($key == 'Image') {
                        echo "<td class='" . $key . "'><img src={$value}></img></td>";
                    }
                    else echo "<td class='" . $key . "'> <p>{$value}</p></td>";
                }    

                if ($name == 'users')
                {
                    echo '<td><a id=m href=/php/admin/modify.php?table=users&id=' . $row['ID'] . '>Modifier</a></th>';
                    echo '<td><a id=s href=/php/admin/delete.php?table=users&id=' . $row['ID'] . '>Supprimer</a></th>';
                }
                if ($name == 'roles')
                {
                    echo '<td><a id=m href=/php/admin/modify.php?table=roles&id=' . $row['ID'] . '>Modifier</a></th>';
                    echo '<td><a id=s href=/php/admin/delete.php?table=roles&id=' . $row['ID'] . '>Supprimer</a></th>';
                }
                if ($name == 'primary_cats')
                {
                    echo '<td><a id=m href=/php/admin/modify.php?table=primary_cats&id=' . $row['ID'] . '>Modifier</a></th>';
                    echo '<td><a id=s href=/php/admin/delete.php?table=primary_cats&id=' . $row['ID'] . '>Supprimer</a></th>';
                }
                if ($name == 'categories')
                {
                    echo '<td><a id=m href=/php/admin/modify.php?table=categories&id=' . $row['ID'] . '>Modifier</a></th>';
                    echo '<td><a id=s href=/php/admin/delete.php?table=categories&id=' . $row['ID'] . '>Supprimer</a></th>';
                }
                if ($name == 'products')
                {
                    echo '<td><a id=m href=/php/admin/modify.php?table=products&id=' . $row['ID'] . '>Modifier</a></th>';
                    echo '<td><a id=s href=/php/admin/delete.php?table=products&id=' . $row['ID'] . '>Supprimer</a></th>'; 
                }
                
            echo '</tr>';
        }
        echo'</table>';
    }

    function french_translate($str, $plu = false)
    {
        if ($plu == false) 
        {
            if ($str == "users") {
                return "un utilisateur";
            }
            if ($str == "roles") {
                return "un rôle";
            }
            if ($str == "primary_cats") {
                return "une catégorie mère";
            }
            if ($str == "categories") {
                return "une catégorie";
            }
            if ($str == "products") {
                return "un produit";
            }
        }
        else
        {
            if ($str == "users") {
                return "les utilisateurs";
            }
            if ($str == "roles") {
                return "les rôles";
            }
            if ($str == "primary_cats") {
                return "les catégories mères";
            }
            if ($str == "categories") {
                return "les catégories";
            }
            if ($str == "products") {
                return "les produits";
            }
        }
        return $str;
    }
?>