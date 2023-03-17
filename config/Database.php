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
                echo "ERROR" . $this->conn;
                return $this->conn;
            } else{
                

                try {
                    //log all values 
                    $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};sslmode = require";
                echo " SOMETHING ERROR" . $dsn;
                    $this->conn = new PDO($dsn, $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "ERROR 2nd" . $this->conn;
                    return $this->conn;
                } catch(PDOException $e) {
                    echo 'Connection Error: ' . $e->getMessage();
                }
            }
        }
}
?>