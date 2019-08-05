<?php

class Client extends Model
{
    //List all users
    public static function listAll()
    {
        $sql = new Sql;
        return $sql->select('SELECT * FROM clients ORDER BY name');
    }
}
