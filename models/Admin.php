<?php
class Admin extends Model
{
    //login a admin
    public static function login($login, $password)
    {
        return AdminDAO::login($login, $password);
    }
}
