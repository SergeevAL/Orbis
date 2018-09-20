<?php

    class Database
    {

        private $host = '127.0.0.1';
        private $db_name = 'f90065eh_db';
        private $username = 'f90065eh_db';
        private $password = 'cake26';
        private $conn;

        public function connect()
        {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            }
            catch(PDOException $e)
            {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }

        
    }

?>
    