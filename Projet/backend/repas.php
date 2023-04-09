<?php

require_once('init_pdo.php');

if (isset($_SERVER['REQUEST_METHOD'])) {
    switch($_SERVER['REQUEST_METHOD']) {

        //SELECTION
        case 'GET' :
            if (isset($_GET['id_repas'])) {
                $request = $pdo->prepare("SELECT * FROM repas 
                JOIN aliments ON id_aliment_mange=id_aliment
                JOIN utilisateurs ON id_mangeur=login
                WHERE id_repas=".$_GET['id_repas']);
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_OBJ);
                $body = json_encode($resultat);
                http_response_code(200);
                header('content-type:application/json');
                echo $body;
            } else if (isset($_GET['id_mangeur'])) {
                $request = $pdo->prepare("SELECT * FROM repas 
                JOIN aliments ON id_aliment_mange=id_aliment
                JOIN utilisateurs ON id_mangeur=login
                WHERE id_mangeur=".$_GET['id_mangeur']);
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_OBJ);
                $body = json_encode($resultat);
                http_response_code(200);
                header('content-type:application/json');
                echo $body;
            } else {
                $request = $pdo->prepare("SELECT * from repas 
                JOIN aliments ON id_aliment_mange=id_aliment
                JOIN utilisateurs ON id_mangeur=login");
                $request -> execute();
                $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
                $body = json_encode($resultat);
                http_response_code(200);
                header('content-type:application/json');
                echo $body;
            }
        break;
        
        //AJOUT
        case 'POST' :
            if (isset($_POST['id_mangeur']) && isset($_POST['id_aliment_mange']) && isset($_POST['qte'])) {
                $request = $pdo->prepare("INSERT INTO `repas` (id_mangeur,id_aliment_mange,qte,date) 
                VALUES ('".$_POST['id_mangeur']."','".$_POST['id_aliment_mange']."','".$_POST['qte']."','".$_POST['date']."')");
                $request -> execute();
                $request = $pdo->prepare("SELECT * FROM `repas` 
                WHERE id_mangeur='".$_POST['id_mangeur']."' AND id_aliment_mange='".$_POST['id_aliment_mange']."' AND date='".$_POST['date']."' AND qte='".$_POST['qte']."'");
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_ASSOC);
                $final_result = array('Location' => 'repas.php?id_repas='.$resultat['id_repas']);
                $final_result['data'] = $resultat;
                $body = json_encode($final_result);
                http_response_code(201);
                header('content-type:application/json');
                echo $body;
            } else {
                $resultat = array('reponse' => "Création impossible. Vérifier que les champs sont bien remplis.");
                $body = json_encode($resultat);
                http_response_code(400);
                header('content-type:application/json');
            }
        break;

        //MODIFICATION
        case 'PUT' :
            $output = json_decode(file_get_contents("php://input"), true);
            if (isset($output['id_repas']) && isset($output['id_mangeur']) && isset($output['id_aliment_mange']) && isset($output['qte'])) {
                $request = $pdo->prepare("SELECT * FROM `repas` 
                WHERE id_repas='".$output['id_repas']."'");
                $request -> execute();
                $old_values = $request->fetch(PDO::FETCH_ASSOC);
                if (isset($old_values['id_repas'])) {
                    $request = $pdo->prepare("UPDATE `repas` 
                    SET `id_mangeur`='".$output['id_mangeur']."', `id_aliment_mange`='".$output['id_aliment_mange']."', `qte`='".$output['qte']."', `date`='".$output['date']."' 
                    WHERE `id_repas`='".$output['id_repas']."'");
                    $request -> execute();
                    $request = $pdo->prepare("SELECT * FROM `repas` 
                    WHERE id_repas='".$old_values['id_repas']."'");
                    $request -> execute();
                    $resultat = $request->fetch(PDO::FETCH_ASSOC);
                    $final_result['old_data'] = $old_values;
                    $final_result['new_data'] = $resultat;
                    $body = json_encode($final_result);
                    http_response_code(200);
                    header('content-type:application/json');
                    echo $body;
                } else {
                    $resultat = array('reponse' => "Modification impossible. Vérifier l'identifiant fourni.");
                    $body = json_encode($resultat);
                    http_response_code(400);
                    header('content-type:application/json');
                    echo $body;
                }
            } else {
                $resultat = array('reponse' => "Modification impossible. Vérifier que les champs sont bien remplis.");
                $body = json_encode($resultat);
                http_response_code(400);
                header('content-type:application/json');
                echo $body;
            }
        break;

        //SUPPRESSION
        case 'DELETE' :
            $output = json_decode(file_get_contents("php://input"), true);
            if (isset($output['id_repas'])) {
                $request = $pdo->prepare("SELECT * FROM `repas` 
                WHERE id_repas='".$output['id_repas']."'");
                $request -> execute();
                $old_values = $request->fetch(PDO::FETCH_ASSOC);
                if (isset($old_values['id_repas'])) {
                    $request = $pdo->prepare("DELETE FROM `repas` 
                    WHERE id_repas='".$old_values['id_repas']."'");
                    $request -> execute();
                    $final_result['reponse'] = "Suppression effectuée";
                    $final_result['old_data'] = $old_values;
                    $body = json_encode($final_result);
                    http_response_code(200);
                    header('content-type:application/json');
                    echo $body;
                }
                else {
                    $resultat = array('reponse' => "Suppression impossible. Vérifier l'identifiant fourni.");
                    $body = json_encode($resultat);
                    http_response_code(400);
                    header('content-type:application/json');
                    echo $body;
                }
            } else {
                $resultat = array('reponse' => "Suppression impossible. Fournir un indentifiant.");
                $body = json_encode($resultat);
                http_response_code(400);
                header('content-type:application/json');
                echo $body;
            }
        break;

        default :
            http_response_code(400);
    }
} else {
    http_response_code(400);
}

/*** close the database connection ***/
$pdo = null;

?>