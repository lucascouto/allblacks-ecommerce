<?php

class Client extends Model
{
    //List all users
    public static function listAll()
    {
        return ClientDAO::listAll();
    }

    //insert a user
    public static function save($data)
    {
        ClientDAO::insert($data);
    }

    //load a specific client by id
    public static function loadById($id)
    {
        return ClientDAO::loadById($id);
    }

    //delete a client
    public static function delete($id)
    {
        return ClientDAO::delete($id);
    }

    //update a client
    public static function update($id, $data)
    {
        if ($client = ClientDAO::loadById($id)) {
            ClientDAO::update($client, $data);
        }
    }

    //login a client
    public static function login($login, $password)
    {
        return ClientDAO::login($login, $password);
    }
}
