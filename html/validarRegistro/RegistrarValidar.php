<?php

namespace validarRegistro;

class RegistrarValidar {

    function compare_password($pass1, $pass2) {
        if ($pass1 === $pass2) {
            $password = $this->hash_pass_register($pass1);
            return $password;
        } else {
            return false;
        }
    }

    function hash_pass_register($password) {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        return $password_hash;
    }

    function valid_email($email) {
        $valid = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$valid) {
            return false;
        } else {
            return true;
        }
    }

}
