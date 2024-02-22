<?php
	// En tete
	header("access-Control-Allow-Origin: *");
	header("Content-type: Application/Json; charset=UTF-8");
	header("access-Control-Allow-Methods: POST");
	require_once'../config/Database.php';
	require_once'../models/Niveau.php';

	// Insatance de la connexion
	if ($_SERVER['REQUEST_METHOD']==="POST") {
		$database=new Database();
		$db=$database->getConnection();

        // Instance de l'objet Niveau
        $niveau=new Niveau($db);
        // Récupération de données envoyées
        $data=json_decode(file_get_contents("php://input"));
        if (!empty($data->nom)) {
            $niveau->nom=htmlspecialchars($data->nom);
            $result=$niveau->addNiveau();

        //Vérification 
            if ($result) {
                http_response_code(201);
                echo(json_encode(["message"=>"Niveau enregistré"]));
            }else {
                http_response_code(503);
                echo(json_encode(["message"=>"Echec d\'enregistrement"]));
            }

        }else {
            echo(json_encode(["message"=>"Les données incomplètes"]));
        }
    }else{
        http_response_code(405);
		echo json_encode(["message"=>"La méthode n\'est pas autorisée"]);
    }