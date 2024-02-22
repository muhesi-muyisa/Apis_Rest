<?php
	// En tete
	header("access-Control-Allow-Origin: *");
	header("Content-type: Application/Json; charset=UTF-8");
	header("access-Control-Allow-Methods: GET");
	require_once'../config/Database.php';
	require_once'../models/Etudiant.php';

	// Insatance de la connexion
	if ($_SERVER['REQUEST_METHOD']==="GET") {
		$database=new Database();
		$db=$database->getConnection();

		// Instance de l'objet etudiant
		$etudiant=new Etudiant($db);

		// Récupération de données 
		$statement=$etudiant->readAll();

		// Vérfication d'existance de données dans la base de données 
		if($statement->rowCount()>0){
			$data=[];
			$data[]=$statement->fetchAll();

			// Renvoie de données sous format Json
			http_response_code(200);
			echo json_encode($data);
		}else{
			echo json_encode(["message"=>"Aucune donnée à renvoyer"]);
		}
	}
	else{
		http_response_code(405);
		echo json_encode(["message"=>"La méthode n\'est pas autorisée"]);
	}

?>