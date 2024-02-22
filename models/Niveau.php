<?php
    class Niveau
    {
        // Toutes les methodes et propriétés nécessaires à la gestion de la table niveau

        private $table="niveau";
        private $connexion=null;

        // propriété de l'objet niveau 
        public $id;
        public $nom;
        public $create_at;

        // Construction de connexion à la base de données
        public function __construct($db){
            if ($this->connexion==null) {
                $this->connexion=$db;
            }
        }

        // Methode d'enregistrement d'un nouveau niveau
        public function addNiveau(){

            // Requette
            $sql="INSERT INTO $this->table (`nom`, `created_at`) VALUES(:nom, NOW())";

            // Preparation de requette
            $req=$this->connexion->prepare($sql);

            // Execution de la requette
            $rq=$req->execute([
                ":nom"=>$this->nom
            ]);
            if($rq) return true;
            else return false;
        }

        // Modification
        public function updateNiveau(){
            $sql="UPDATE $this->table SET nom=:nom WHERE id=:id";

            // Prépare
            $req=$this->connexion->prepare($sql);
            // Execution de la requette
            $rq=$req->execute([
                ":id"=>$this->id,
                ":nom"=>$this->nom
            ]);
            if($rq) return true;
            else return false;
        }


        public function deleteNiveau(){
            $sql="DELETE FROM $this->table WHERE id=:id";

            // Prépare
            $req=$this->connexion->prepare($sql);
            // Execution de la requette
            $rq=$req->execute([
                ":id"=>$this->id,
            ]);
            if($rq) return true;
            else return false;
        }
        
        public function readAllNiveau(){
            $sql="SELECT * FROM $this->table ORDER BY id DESC";
            $req=$this->connexion->query($sql);
            return $req;
        }
    }
    
?>