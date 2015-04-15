<?php
namespace Uniwars;

class Db
{
    /**
     * @var \PDO
     */
    private $conn;

    /**
     * @var \PDOStatement
     */
    private $stmt;

    /**
     * @var Db
     */
    private static $inst = null;

    private function __construct($user, $pass, $dbName, $host)
    {
        $dsn = 'mysql:dbname='.$dbName .';host='. $host;
        $this->conn = new \PDO($dsn, $user, $pass);
    }

    public static function setInstance($user, $pass, $dbName, $host)
    {
        if (self::$inst == null)
        {
            self::$inst = new self($user, $pass, $dbName, $host);
        }
    }

    /**
     * @return Db
     */
    public static function getInstance()
    {
        return self::$inst;
    }

    /**
     * @param $query
     * @param array $params
     */
    public function query($query, array $params = [])
    {
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($params);
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        return $this->stmt->fetchAll();
    }

    /**
     * @return mixed
     */
    public function row()
    {
        return $this->stmt->fetch();
    }

    /**
     * @return int
     */
    public function rows()
    {
        return $this->stmt->rowCount();
    }


}