<?php
class Sql
{

    private $dsn;
    private $password;
    private $username;
   
    private $conn;

    public function __construct()
    {
        $dbconfig = file('../dbconfig');
        
        $this->dsn = str_replace(PHP_EOL, '', substr($dbconfig[0], 4));
        $this->username = str_replace(PHP_EOL, '', substr($dbconfig[1], 9));
        $this->password =str_replace(PHP_EOL, '', substr($dbconfig[2], 9));

        $this->conn = new PDO($this->dsn, $this->username, $this->password);
    }

    private function setParams($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    public function query($rawQuery, $params = [])
    {
        $stmt = $this->conn->prepare($rawQuery);

        foreach ($params as $key => $value) {
            $this->setParams($stmt, $key, $value);
        }

        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = []): array
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}