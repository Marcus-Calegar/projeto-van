<?php
define("SERVER", "mysql:host=localhost;dbname=projetoVan");
define("USER", "root");
define("PWD", "");

class Conexao
{
    private $conn;
    public function __construct()
    {
        $this->conn = new PDO(SERVER, USER, PWD);
    }
    public function preparar($sql)
    {
        return $this->conn->prepare($sql);
    }
    public function comando($sql)
    {
        return $this->conn->query($sql);
    }
}
