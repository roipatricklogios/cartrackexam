<?php

    class Connection {
        private $host = "localhost";
        private $db_name = "cartrackexam";
        private $dbuser = "root";
        private $dbpass = "Thu$$0661";
        private $connection;


        public function connect(){
            $this->connection = null;

            try {
                $this->connection = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->db_name, $this->dbuser, $this->dbpass .',sslmode=require' );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "test connection ok";
            } catch (\Throwable $th) {
                echo "Connection Error".$th->getMessage();
            }

            return $this->connection;
        }
    }

?>