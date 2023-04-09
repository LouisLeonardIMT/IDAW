<?php

require_once('init_pdo.php');

if (isset($_SERVER['REQUEST_METHOD'])) {
    switch($_SERVER['REQUEST_METHOD']) {

        //SELECTION
        case 'GET' :
            if (isset($_GET['id_aliment'])) {
                $request = $pdo->prepare("SELECT * FROM aliments 
                JOIN types_aliments ON id_type_aliment=id_type 
                WHERE id_aliment=".$_GET['id_aliment']);
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_OBJ);
                $body = json_encode($resultat);
                http_response_code(200);
                header('content-type:application/json');
                echo $body;
            } else if (isset($_GET['id_type_aliment'])) {
                $request = $pdo->prepare("SELECT * FROM aliments 
                JOIN types_aliments ON id_type_aliment=id_type 
                WHERE id_type_aliment=".$_GET['id_type_aliment']);
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_OBJ);
                $body = json_encode($resultat);
                http_response_code(200);
                header('content-type:application/json');
                echo $body;
            } else {
                $request = $pdo->prepare("SELECT * FROM aliments
                JOIN types_aliments ON id_type_aliment=id_type");
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
            if (isset($_POST['nom']) && isset($_POST['id_type_aliment'])) {
                $request = $pdo->prepare("INSERT INTO `aliments` (nom,id_type_aliment,calories,glucides,sucres,lipides,acides_gras,proteines,sel) 
                VALUES ('".$_POST['nom']."','".$_POST['id_type_aliment']."','".$_POST['calories']."','".$_POST['glucides']."','".$_POST['sucres']."','".$_POST['lipides']."','".$_POST['acides_gras']."','".$_POST['proteines']."','".$_POST['sel']."')");
                $request -> execute();
                $request = $pdo->prepare("SELECT * FROM `aliments` 
                WHERE nom='".$_POST['nom']."' AND id_type_aliment='".$_POST['id_type_aliment']."'");
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_ASSOC);
                $final_result = array('Location' => 'aliments.php?id_aliment='.$resultat['id_aliment']);
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
            if (isset($output['id_aliment']) && isset($output['nom']) && isset($output['id_type_aliment'])) {
                $request = $pdo->prepare("SELECT * FROM `aliments` WHERE id_aliment='".$output['id_aliment']."'");
                $request -> execute();
                $old_values = $request->fetch(PDO::FETCH_ASSOC);
                if (isset($old_values['id_aliment'])) {
                    $request = $pdo->prepare("UPDATE `aliments` 
                    SET `nom`='".$output['nom']."', `id_type_aliment`='".$output['id_type_aliment']."', `calories`='".$output['calories']."', `glucides`='".$output['glucides']."', `sucres`='".$output['sucres']."', `lipides`='".$output['lipides']."', `acides_gras`='".$output['acides_gras']."', `proteines`='".$output['proteines']."', `sel`='".$output['sel']."' 
                    WHERE `id_aliment`='".$output['id_aliment']."'");
                    $request -> execute();
                    $request = $pdo->prepare("SELECT * FROM `aliments` 
                    WHERE id_aliment='".$old_values['id_aliment']."'");
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
            if (isset($output['id_aliment'])) {
                $request = $pdo->prepare("SELECT * FROM `aliments` 
                WHERE id_aliment='".$output['id_aliment']."'");
                $request -> execute();
                $old_values = $request->fetch(PDO::FETCH_ASSOC);
                if (isset($old_values['id_aliment'])) {
                    $request = $pdo->prepare("DELETE FROM `aliments` 
                    WHERE id_aliment='".$old_values['id_aliment']."'");
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