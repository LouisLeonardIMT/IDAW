<?php

require_once('init_pdo.php');

if (isset($_SERVER['REQUEST_METHOD'])) {
    switch($_SERVER['REQUEST_METHOD']) {
        
        //SELECTION
        case 'GET' :
            if (isset($_GET['login']) && isset($_GET['password'])) {
                $request = $pdo->prepare("SELECT login FROM `utilisateurs` 
                WHERE login='".$_GET['login']."' AND password='".$_GET['password']."'");
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_ASSOC);
                if (isset($resultat['login'])) {
                    $response = array("response" => true);
                } else {
                    $response = array("response" => false);
                }
                $body = json_encode($response);
                http_response_code(200);
                header('content-type:application/json');
                echo $body;
            } else if (isset($_GET['login'])) {
                $request = $pdo->prepare("SELECT * FROM `utilisateurs` 
                JOIN profils_sportifs ON profil=id_profil 
                JOIN sexe ON sexe=id_sexe
                WHERE login='".$_GET['login']."'");
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_OBJ);
                $body = json_encode($resultat);
                http_response_code(200);
                header('content-type:application/json');
                echo $body;
            } else {
                $request = $pdo->prepare("SELECT * FROM `utilisateurs` 
                JOIN profils_sportifs ON profil=id_profil 
                JOIN sexe ON sexe=id_sexe");
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
            if (isset($_POST['login']) &&isset($_POST['nom']) && isset($_POST['age']) && isset($_POST['taille']) && isset($_POST['poids'])) {
                $request = $pdo->prepare("INSERT INTO `utilisateurs` (login,nom,age,sexe,taille,poids,profil) 
                VALUES ('".$_POST['login']."','".$_POST['nom']."','".$_POST['age']."','".$_POST['sexe']."','".$_POST['taille']."','".$_POST['poids']."','".$_POST['profil']."')");
                $request -> execute();
                $request = $pdo->prepare("SELECT * FROM `utilisateurs` 
                WHERE login='".$_POST['login']."' AND age='".$_POST['age']."' AND taille='".$_POST['taille']."' AND poids='".$_POST['poids']."'");
                $request -> execute();
                $resultat = $request->fetch(PDO::FETCH_ASSOC);
                $final_result = array('Location' => 'utilisateurs.php?login='.$resultat['login']);
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
            if (isset($output['login']) && isset($output['nom']) && isset($output['age']) && isset($output['taille']) && isset($output['poids'])) {
                $request = $pdo->prepare("SELECT * FROM `utilisateurs` 
                WHERE login='".$output['login']."'");
                $request -> execute();
                $old_values = $request->fetch(PDO::FETCH_ASSOC);
                if (isset($old_values['login'])) {
                    $request = $pdo->prepare("UPDATE `utilisateurs` 
                    SET `nom`='".$output['nom']."', `age`='".$output['age']."', `sexe`='".$output['sexe']."', `taille`='".$output['taille']."', `poids`='".$output['poids']."', `profil`='".$output['profil']."' 
                    WHERE `login`='".$output['login']."'");
                    $request -> execute();
                    $request = $pdo->prepare("SELECT * FROM `utilisateurs` 
                    WHERE login='".$output['login']."'");
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
            }
        break;

        //SUPPRESSION
        case 'DELETE' :
            $output = json_decode(file_get_contents("php://input"), true);
            if (isset($output['login'])) {
                $request = $pdo->prepare("SELECT * FROM `utilisateurs` 
                WHERE login='".$output['login']."'");                
                $request -> execute();
                $old_values = $request->fetch(PDO::FETCH_ASSOC);
                if (isset($old_values['login'])) {
                    $request = $pdo->prepare("DELETE FROM `utilisateurs` 
                    WHERE login='".$old_values['login']."'");
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