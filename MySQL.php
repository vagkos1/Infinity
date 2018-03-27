<?php

namespace Infinity;

class MySQL 
{
    private $host;
    private $db;
    private $port;
    private $user;
    private $password;

    /**
     * MySQL constructor. 
     * 
     * These values should be coming from a gitignored config file of some sort.
     * 
     * @param $host
     * @param $db
     * @param $port
     * @param $user
     * @param $password
     */
    public function __construct($host, $db, $port = 3306, $user, $password)
    {
        $this->host = $host;
        $this->db = $db;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }
    
    /**
     * @return \PDO
     * 
     * @throws \PDOException if a connection is not established
     */
    public function PDOConnect()
    {
        try {
            $pdo = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . ";port=" . $this->port, $this->user , $this->password);
            $pdo->exec("set names utf8");
            $pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
            return $pdo;
        }
        catch (\PDOException $e) {
            die('An error has occurred. Please check the address or try again later.');
        }
    }

}