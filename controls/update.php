<?php
	// En tete
	header("access-Control-Allow-Origin: *");
	header("Content-type: Application/Json; charset=UTF-8");
	header("access-Control-Allow-Methods: PUT");
	require_once'../config/Database.php';
	require_once'../models/Etudiant.php';

	// Insatance de la connexion
	if ($_SERVER['REQUEST_METHOD']==="PUT") {
		$database=new Database();
		$db=$database->getConnection();

		// Instance de l'objet etudiant
		$etudiant=new Etudiant($db);

        // Récupération de données envoyées
        $data=json_decode(file_get_contents("php://input"));
        if (!empty($data->id) && !empty($data->nom)&& !empty($data->prenom)&& !empty($data->age) && !empty($data->niveau_id)) {

            // On hydrate les données 
            $etudiant->id=htmlspecialchars($data->id);
            $etudiant->nom=htmlspecialchars($data->nom);
            $etudiant->prenom=htmlspecialchars($data->prenom);
            $etudiant->age=htmlspecialchars($data->age);
            $etudiant->niveau_id=htmlspecialchars($data->niveau_id);
            $result=$etudiant->update();

            if ($result) {
                http_response_code(201);
                echo(json_encode(["message"=>"Etudiant modifié"]));
            }else {
                http_response_code(503);
                echo(json_encode(["message"=>"Echec de modification"]));
            }

        }else {
            echo(json_encode(["message"=>"données incomplètes"]));
        }

    }else {
        http_response_code(405);
		echo json_encode(["message"=>"La méthode n\'est pas autorisée"]);
    }