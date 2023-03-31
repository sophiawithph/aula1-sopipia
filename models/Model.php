<?php
class Model
{

    // forma menos indicada para armazenar usuário e senha

    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'sistematwig';
    private $port = '3306';
    private $user = 'root';
    private $password = null;

    
    protected $table;
    protected $conex;

    public function __construct()
    {
        //descobre nome tabela
        $tbl = strtolower(get_class($this));
        $tbl .= 's';
        $this ->table = $tbl;

        $this->conex = new PDO("{$this-> driver}:host={$this->host}; port={$this->port}; dbname={$this->dbname}", $this->user, $this->password);
    }

        public function getALL(){
            $sql = $this ->conex->query("SELECT * FROM {$this ->table} ");

            return $sql -> fetchALL(PDO::FETCH_ASSOC);
        }
     public function getById($id){
         $sql = $this-> conex-> prepare("SELECT * FROM {$this -> table} WHERE id = ?");
         $sql -> bindParam(1, $id);
         $sql -> execute();
         return $sql ->fetch(PDO::FETCH_ASSOC);
     }
}