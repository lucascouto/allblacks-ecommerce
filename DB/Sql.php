<?php
class Sql
{
    private $dbtype;
    private $dbname;
    private $host;
    private $port;
    private $dsn;
    private $password;
    private $username;

    private $conn;

    public function __construct()
    {
        $dbconfig = file($_SERVER['DOCUMENT_ROOT'] . '/allblacks-ecommerce/dbconfig');

        $this->dbtype = str_replace(PHP_EOL, '', substr($dbconfig[0], 7));
        $this->host = str_replace(PHP_EOL, '', substr($dbconfig[1], 5));
        $this->port = str_replace(PHP_EOL, '', substr($dbconfig[2], 5));
        $this->dbname = str_replace(PHP_EOL, '', substr($dbconfig[3], 7));

        //CALL THE APPROPRIATE DSN ACCORDING WITH DATABASE TYPE
        if ($this->dbtype == 'mysql')
            $this->dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname;
        elseif ($this->dbtype == 'sqlsrv')
            $this->dsn = 'sqlsrv:Server=' . $this->host . ',' . $this->port . ';Database=' . $this->dbname;

        $this->username = str_replace(PHP_EOL, '', substr($dbconfig[4], 9));
        $this->password = str_replace(PHP_EOL, '', substr($dbconfig[5], 9));

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
