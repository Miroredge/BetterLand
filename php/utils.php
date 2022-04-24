<?php
    // Path: php\utils.php

    function replace_if_unknown($str) {
        return ($str == "" or $str == "0") ? "Non Renseigné" : $str;
    }

    function escape_string($str) {
        return str_replace("'", "''", $str);
    }

    function check_password($password) {
        $is_valid = false;
        if (strlen($password) >= 6) 
        {
            if(preg_match_all("#[0-9]+#", $password)) 
            {
                if(preg_match_all("#[a-z]+#", $password)) 
                {
                    if (preg_match_all("#[A-Z]+#", $password)) 
                    {
                        if (preg_match_all("#[^0-9a-zA-Z_*%!§:/;]+#", $password) == 0) 
                        {
                            $is_valid = true;
                        }
                        else 
                        {
                            $_SESSION["error"] = "Le mot de passe ne doit pas contenir de caractères spéciaux autre que '_*%!§:/;'";
                        }
                    }
                    else 
                    {
                        $_SESSION["error"] = "Le mot de passe doit contenir au moins une majuscule";
                    }
                }
                else 
                {
                    $_SESSION["error"] = "Le mot de passe doit contenir au moins une minuscule";
                }
            }
            else 
            {
                $_SESSION["error"] = "Le mot de passe doit contenir au moins un chiffre";
            }
        }
        else 
        {
            $_SESSION["error"] = "Le mot de passe doit contenir au moins 6 caractères";
        }
        return $is_valid;
    }

    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    function is_uuid($str) {
        return preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/', $str);
    }

    function send_mail($to, $pwd_tmp, $reason)
    {
        if ($reason === 'Mot de passe oublié') 
        {
            $subject = "PaperLand - " . $reason;
            $message = "Bonjour,\n\n";
            $message .= "Vous avez demandé la récupération de votre mot de passe.\n\n";
            $message .= "Veuillez indiquer le mot de passe suivant à votre prochaine connexion :\n\n";
            $message .= "Mot de passe : " . $pwd_tmp . "\n\n";

            $headers = "From: PaperLand";

            $state = mail($to, $subject, $message, $headers);

            if ($state) 
            {
            }
            else 
            {
                $_SESSION["error"] = "Une erreur est survenue lors de l'envoi du mail.";
            }
        }
    }
?>