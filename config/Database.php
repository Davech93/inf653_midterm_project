<?php
    class Database {
        //DB params
       private $conn;
       private $host;
       private $port;
       private $dbname;
       private $username;
       private $password;

        public function __construct() {
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->dbname = getenv('DBNAME');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');
        }
// check connection

        public function connect() {
            if ($this->conn){
                return $this->conn;
            } else{
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};";

                try {
                    //log all values 
                    $this->conn = new PDO($dsn, $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this->conn;
                } catch(PDOException $e) {
                    echo 'Connection Error: ' . $e->getMessage();
                }
            }
        }
}
?>