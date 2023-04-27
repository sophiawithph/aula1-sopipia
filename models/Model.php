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
        $this->table = $tbl;

        $this->conex = new PDO("{$this->driver}:host={$this->host}; port={$this->port}; dbname={$this->dbname}", $this->user, $this->password);
    }

    public function getALL($where, $where_glue = 'AND')
    {
        if ($where) {
            $where_sql = $this->where_fields($where, $where_glue);
            $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE {$where_sql} ");
            $sql -> execute($where);
        }
        return $sql->fetchALL(PDO::FETCH_ASSOC);
    }



    public function getById($id)
    {
        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $sql->bindParam(1, $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        //inicia a construção do sql
        $sql = "INSERT INTO {$this->table}";


        $sql_fields = $this->sql_fields($data);
        //monta a consulta
        $sql .= " SET {$sql_fields}";
        //prepara e rodao banco
        $insert = $this->conex->prepare($sql);
        // faz os binds nos valores
        //foreach ($data as $field => $value) {
        //   $insert->bindValue(":{$field}", $value);}

        $insert->execute($data);
        return $insert->errorInfo();
    }
    public function update($data, $id)
    {
        unset($data['id']);
        $sql = "UPDATE {$this->table}";
        $sql .= ' SET ' . $this->sql_fields($data);
        $sql .= ' WHERE id =:id';

        $data['id'] = $id;

        $upd = $this->conex->prepare($sql);
        $upd->execute($data);
    }

    private function map_fields($data)
    {
        foreach (array_keys($data) as $field) {
            $sql_fields[] = "{$field} = :{$field}";
        }
        return $sql_fields;
    }
    private function sql_fields($data)
    {
        //prepara os campos e placeholders
        $sql_fields = $this->map_fields($data);
        return implode(',', $sql_fields);
    }
    private function where_fields($data, $glue = "AND")
    {
        $glue = $glue == 'OR' ? ' OR ' : ' AND ';
        $fields = $this->map_fields($data);
        return implode($glue, $fields);
    }

}