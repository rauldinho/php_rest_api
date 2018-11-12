<?php
class Database
{
    //Parametros DB
    private $host = 'localhost';
    private $db = 'db_rest';
    private $user = 'root';
    private $pass = '';
    private $conn;

    //Conexion DB
    public function connect()
    {
        $this->conn = NULL;

        try
        {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo 'Error de conexion: '.$e->getMessage();
        }

        return $this->conn;
    }
}