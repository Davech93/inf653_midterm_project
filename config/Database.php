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

        public function connect() {
            if ($this->conn){
                return $this->conn;
            } else{
                $dsn = "pgsql:host="dpg-cg8eukqk728pus4qm5q0-a.oregon-postgres.render.com";port="5432";dbname="quotesdb_nu96";";

                try {
                    $this->conn = new PDO($dsn, "quotesdb_nu96_user", "ry2c06ulH6Z2UjW3qwkLyOsOF0raAiEJ");
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this->conn;
                } catch(PDOException $e) {
                    echo 'Connection Error: ' . $e->getMessage();
                }
            }
        }
}
?>