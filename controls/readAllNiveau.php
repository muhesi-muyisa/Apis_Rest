<?php
	// En tete
	header("access-Control-Allow-Origin: *");
	header("Content-type: Application/Json; charset=UTF-8");
	header("access-Control-Allow-Methods: GET");
	require_once'../config/Database.php';
	require_once'../models/Niveau.php';

	// Insatance de la connexion
	if ($_SERVER['REQUEST_METHOD']==="GET") {
		$database=new Database();
		$db=$database->getConnection();

        $niveau=new Niveau($db);
        $statement=$niveau->readAllNiveau();

		// Vérfication d'existance de données dans la base de données 
		if($statement->rowCount()>0){
			$data=[];
			$data[]=$statement->fetchAll();

			// Renvoie de données sous format Json
			http_response_code(200);
			$datas=json_encode($data);
            echo $datas;
		}else{
			echo json_encode(["message"=>"Aucune donnée à renvoyer"]);
		}
    }else{

    }