<?php
class Sql
{
    const HOSTNAME = '127.0.0.1';
    const DBNAME = 'allblacks_ecommerce';
    const DSN = 'mysql:dbname=' . DBNAME . ';host=' . HOSTNAME;
    const PASSWORD = 'root';
    const USERNAME = 'root';
    const OPTIONS = null;

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO(Sql::DSN, sql::USERNAME, sql::PASSWORD, sql::OPTIONS);
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