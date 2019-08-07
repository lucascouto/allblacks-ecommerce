<?php

class AdminDAO
{
    public static function login($login, $password)
    {

        $sql = new Sql;

        $results = $sql->select('SELECT * FROM admin WHERE login = :LOGIN AND password = :PASSWORD', [
            ':LOGIN' => $login,
            ':PASSWORD' => $password
        ]);

        if (count($results) > 0) {
            $admin = new Admin;
            $admin->setData($results[0]);
            $_SESSION['Admin'] = $admin->getValues();
            return $admin;
        } else {
            return false;
        }
    }
}
