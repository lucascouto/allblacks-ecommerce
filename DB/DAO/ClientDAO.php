<?php
class ClientDAO
{
    public static function listAll()
    {
        $sql = new Sql;
        return $sql->select('SELECT * FROM clients ORDER BY dt_created desc');
    }

    public static function loadById($id)
    {
        $client = new Client;

        $sql = new Sql;
        $results = $sql->select('SELECT * FROM clients WHERE idclient = :ID', [
            ':ID' => $id
        ]);

        if (count($results) > 0) {
            $client->setData($results[0]);
            return $client;
        } else {
            return false;
        }
    }

    public static function insert($data)
    {
        $client = new Client;

        $client->setData($data);

        $sql = new Sql;
        $sql->select('CALL sp_clients_save (:name, :document, :zip_code, :address, 
                                :neighborhood, :city, :state, :phone, 
                                :email, :active)', [
            ':name' => $client->getname(),
            ':document' => $client->getdocument(),
            ':zip_code' => $client->getzipcode(),
            ':address' => $client->getaddress(),
            ':neighborhood' => $client->getneighborhood(),
            ':city' => $client->getcity(),
            ':state' => $client->getstate(),
            ':phone' => $client->getphone(),
            ':email' => $client->getemail(),
            ':active' => $client->getactive()
        ]);
    }

    public static function delete($id)
    {
        $sql = new Sql;
        $result = $sql->query('DELETE FROM clients WHERE idclient = :ID', [
            ':ID' => $id
        ]);

        if ($result->rowCount() > 0)
            return true;
        else
            return false;
    }

    public static function update(Client $client, $data)
    {
        $client->setData($data);

        $sql = new Sql;

        $client = $sql->select("UPDATE clients SET name = :NAME, 
                                document = :DOCUMENT, 
                                zip_code = :ZIPCODE, 
                                address = :ADDRESS, 
                                neighborhood = :NEIGHBORHOOD, 
                                city = :CITY, 
                                state = :STATE, 
                                phone = :PHONE, 
                                email = :EMAIL, 
                                active = :ACTIVE
                                WHERE idclient = :ID", [
            ':NAME' => $client->getname(),
            ':DOCUMENT' => $client->getdocument(),
            ':ZIPCODE' => $client->getzipcode(),
            ':ADDRESS' => $client->getaddress(),
            ':NEIGHBORHOOD' => $client->getneighborhood(),
            ':CITY' => $client->getcity(),
            ':STATE' => $client->getstate(),
            ':PHONE' => $client->getphone(),
            ':EMAIL' => $client->getemail(),
            ':ACTIVE' => $client->getactive(),
            ':ID' => $client->getidclient()
        ]);
    }

    public static function login($login, $password)
    {

        $sql = new Sql;
        /* 
            To simulate a login system, it was used  the 'document' field 
            as login and the 'zip_code' field as password
        */
        $results = $sql->select('SELECT * FROM clients WHERE document = :LOGIN AND zip_code = :PASSWORD', [
            ':LOGIN' => $login,
            ':PASSWORD' => $password
        ]);

        if (count($results) > 0) {
            $client = new Client;
            $client->setData($results[0]);
            $_SESSION['Client'] = $client->getValues();
            return $client;
        } else {
            return false;
        }
    }
}
