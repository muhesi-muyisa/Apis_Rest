<?php 
    // Classe de connexion à la base des données
    class Database{
        // Propriétés de connexion à la bdd
        private $host="localhost";
        private $dbName="php_api_rest";
        private $dbUser="root";
        private $dbPass="";
        // Methode de connexion 
        public function getConnection(){
            $conn=null;
            try {
                $conn=new PDO("mysql:host=$this->host;dbname=$this->dbName;charset=utf8",
                $this->dbUser,
                $this->dbPass,
                [
                    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
                ]);
            } catch (\PDOException $e) {
                echo("Erreur de connexion : ".$e->getMessage());
            }
            return $conn;
        }
    }
?>