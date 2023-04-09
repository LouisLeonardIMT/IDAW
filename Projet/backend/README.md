# Documentation de l'API


## Requêtes possibles : aliments.php
  
GET
— Paramètres : id_aliment de l'aliment recherché  
— Résultat : renvoie l'ensemble des informations de l'aliment d'identifiant id_aliment. Si aucun id n'est fourni, renvoie l'ensemble des aliments de la base.
  
POST 
— Paramètres : tous les champs de l’aliment à créer (nom -> string, id_type_aliment -> entier, calories -> entier, glucides -> flottant, sucres -> flottant, lipides -> flottant, acides_gras -> flottant, proteines -> flottant, sel -> flottant) sauf le champ id_aliment. Les champs id_aliment, nom, id_type_aliment doivent être spécifiés.  
— Résultat : ajoute un aliment avec les valeurs fournies dans les champs.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté.  
  
PUT
— Paramètres : tous les champs de l’aliment à créer (id_aliment -> entier, nom -> string, id_type_aliment -> entier, calories -> entier, glucides -> flottant, sucres -> flottant, lipides -> flottant, acides_gras -> flottant, proteines -> flottant, sel -> flottant) Les champs id_aliment, nom, id_type_aliment doivent être spécifiés. L'id_aliment ne peut être modifié.  
— Résultat : modifie les valeurs de l'aliment à l'id fourni.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté.
  
DELETE  
— Paramètres : le id_aliment de l'aliment à supprimer (id_aliment)  
— Résultat : supprime l'aliment à l'id fourni.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté. 


## Requêtes possibles : repas.php
  
GET 
— Paramètres : id_repas du repas recherché ou id_mangeur de l'utilisateur recherché  
— Résultat : renvoie l'ensemble des informations du repas d'identifiant id_repas ou de l'utilisateur d'identifiant id_mangeur. Si aucun id n'est fourni, renvoie l'ensemble des aliments de la base.

  
POST  
— Paramètres : tous les champs du repas à créer (id_mangeur -> string, id_aliment_mange -> entier, qte -> flottant, date -> date) sauf le champ id_repas. Les champs id_mangeur, id_aliment_mange et qte doivent être spécifiés.
— Résultat : ajoute un repas avec les valeurs fournies dans les champs.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté.  
  
  
PUT 
— Paramètres : tous les nouveaux champs du repas à modifier (id_repas -> entier, id_mangeur -> string, id_aliment_mange -> entier, qte -> flottant, date -> date). Les champs id_repas, id_mangeur, id_aliment_mange et qte doivent être spécifiés. L'id_repas ne peut être modifié.
— Résultat : modifie les valeurs du repas à l'id fourni.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté. 
  
DELETE  
— Paramètres : le id_repas du repas à supprimer  
— Résultat : supprime le repas à l'id fourni.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté. 

## Requêtes possibles : utilisateurs.php  
GET
— Paramètres : login (id) de l'utilisateur recherché  
— Résultat : renvoie l'ensemble des informations de l'utilisateur d'identifiant id. Si aucun id n'est fourni, renvoie l'ensemble des utilisateurs de la base.
  
POST
— Paramètres : tous les champs de l’utilisateur à créer (nom -> string, age -> entier, sexe -> entier, taille -> flottant, poids -> flottant, profil -> entier) à part le champ id. Les champs login, nom, age, taille et poids doivent être spécifiés. 
— Résultat : ajoute un utilisateur avec les valeurs fournies dans les champs.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté.  
  
PUT
— Paramètres : tous les nouveaux champs de l’utilisateur à modifier (login -> string, nom -> string, age -> entier, sexe -> entier, taille -> flottant, poids -> flottant, profil -> entier). L'identifiant ne peut être modifié. Si un ou plusieurs champs ne sont pas modifiés il faut indiquer les mêmes valeurs que les anciennes.  
— Résultat : modifie les valeurs de l'utilisateur au login fourni.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté.
  
DELETE
— Paramètres : login de l'utilisateur à supprimer  
— Résultat : supprime l'utilisateur au login fourni.
En cas d’erreur, retourne le code d’erreur de statut HTTP adapté.