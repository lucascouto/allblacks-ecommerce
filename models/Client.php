<?php

class Client extends Model
{
    //List all users
    public static function listAll()
    {
        $sql = new Sql;
        return $sql->select('SELECT * FROM clients ORDER BY name');
    }

    //insert a user
    public function save($data)
    {
        $this->setData($data);

        $sql = new Sql;
        $results = $sql->select('CALL sp_clients_save (:name, :document, :zip_code, :address, 
                                :neighborhood, :city, :state, :phone, 
                                :email, :active)', [
            ':name' => $this->getname(),
            ':document' => $this->getdocument(),
            ':zip_code' => $this->getzipcode(),
            ':address' => $this->getaddress(),
            ':neighborhood' => $this->getneighborhood(),
            ':city' => $this->getcity(),
            ':state' => $this->getstate(),
            ':phone' => $this->getphone(),
            ':email' => $this->getemail(),
            ':active' => $this->getactive()
        ]);
        //$this->setData($results[0]);
    }
}
