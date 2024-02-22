<?php
//require '../config/Database.php';
    class Etudiant 
    {
        // Toutes les methodes et propriétés nécessaires à la gestion de la table etudiant
        private $table="etudiants";
        private $connexion=null;

        // Propriétés de l'objet
        public $id;
        public $nom;
        public $prenom;
        public $age;
        public $niveau_id; 
        public $niveau_nom;
        public $create_at;

        // Constructeur de connexion 
        public function __construct($db)
        {
            if ($this->connexion==null) {
                $this->connexion=$db;
            }
        }

        // La lecture des étudiants 
        public function readAll(){
            // On écrit la requtte 
            $sql="SELECT e.id,e.nom, prenom,age, niveau_id, e.created_at, n.nom as nomNiveau FROM $this->table e LEFT JOIN niveau n ON niveau_id=n.id ORDER BY e.created_at DESC";
            $req=$this->connexion->query($sql);
            return $req;
        }

        // La création d'un etudiant
        public function create(){
            $sql="INSERT INTO $this->table(`nom`, `prenom`, `age`, `niveau_id`, `created_at`) VALUES(:nom, :prenom, :age, :niveau_id, NOW())";
            // Prépartion de la requtte 
            $req=$this->connexion->prepare($sql);

            // Execution de la requette
            $rq=$req->execute([
                ":nom"=>$this->nom,
                ":prenom"=>$this->prenom,
                ":age"=>$this->age,
                ":niveau_id"=>$this->niveau_id,
            ]);

            // Condition 
            if ($rq) return true;
            else return false; 
        }

        // Modification de l'étudiant
        public function update(){
            $sql="UPDATE $this->table SET nom=:nom, prenom=:prenom, age=:age, niveau_id=:niveau_id WHERE id=:id";

            // Préparation de la requette
            $req=$this->connexion->prepare($sql);

            // Execution de la requtte
            $rq=$req->execute([
                ":id"=>$this->id,
                ":nom"=>$this->nom,
                ":prenom"=>$this->prenom,
                ":age"=>$this->age,
                ":niveau_id"=>$this->niveau_id
            ]);
            // Vérification de l'execution de la requette
            if ($rq) return true;
            else return false;
        }

        // Suppression de l'étudiant
        public function delete(){
            $sql="DELETE FROM $this->table WHERE id=:id";

            // Préparation de la requette
            $req=$this->connexion->prepare($sql);

            // Execution de la requete
            $rq=$req->execute([
                ":id"=>$this->id
            ]);
            if($rq) return true;
            else return false;
        }
        
    }
    
?>