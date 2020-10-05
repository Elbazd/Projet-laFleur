<?php

// MODIFs A FAIRE
// Ajouter en têtes 
// Voir : jeu de caractères à la connection

/** 
 * Se connecte au serveur de données                     
 * Se connecte au serveur de données à partir de valeurs
 * prédéfinies de connexion (hôte, compte utilisateur et mot de passe). 
 * Retourne l'identifiant de connexion si succès obtenu, le booléen false 
 * si problème de connexion.
 * @return resource identifiant de connexion
 */
function connecterServeurBD() 
{
    $PARAM_hote='localhost'; // le chemin vers le serveur
    $PARAM_port='3306';
    $PARAM_nom_bd='gsbvincent'; // le nom de votre base de données
    $PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe='root'; // mot de passe de l'utilisootateur pour se connecter
    $connect = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
    return $connect;

    //$hote = "localhost";
    // $login = "root";
    // $mdp = "";
    // return mysql_connect($hote, $login, $mdp);
}


/** 
 * Ferme la connexion au serveur de données.
 * Ferme la connexion au serveur de données identifiée par l'identifiant de 
 * connexion $idCnx.
 * @param resource $idCnx identifiant de connexion
 * @return void  
 */
function deconnecterServeurBD($idCnx) {

}


function lister($categ)
{
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
      
           
      $requete="select * from visiteur";
       
       
       
      
      
      $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

      $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
      $i = 0;
      $ligne = $jeuResultat->fetch();
      while($ligne)
      {
          $fleur[$i]['mat']=$ligne->VIS_MATRICULE;
          $fleur[$i]['nom']=$ligne->VIS_NOM;
          $fleur[$i]['prenom']=$ligne->VIS_PRENOM;
          $fleur[$i]["adresse"]=$ligne->VIS_ADRESSE;
          $ligne=$jeuResultat->fetch();
          $i = $i + 1;
      }
  }
  $jeuResultat->closeCursor();   // fermer le jeu de résultat
  // deconnecterServeurBD($idConnexion);
  return $fleur;
}


function ajouter($mat, $nm, $prm, $adrs,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
    
    // Vérifier que la référence saisie n'existe pas déja
    $requete="select * from visiteur";
    $requete=$requete." where VIS_MATRICULE = '".$mat."';"; 
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if($ligne)
    {
      $message="Echec de l'ajout : la référence existe déjà !";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      // Créer la requête d'ajout 
       $requete="insert into visiteur"
       ."(VIS_MATRICULE,VIS_NOM,VIS_PRENOM,VIS_ADRESSE) values ('"
       .$mat."','"
       .$nm."','"
       .$prm."','"
       .$adrs."');";
       
        // Lancer la requête d'ajout 
        $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
       
        // Si la requête a réussi
        if ($ok)
        {
          $message = "Le visiteur a été correctement ajouté";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, l'ajout du visiteur a échoué !";
          ajouterErreur($tabErr, $message);
        } 

    }
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "problème à la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}


function supprimer($mat,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
    
    // Vérifier que la référence saisie n'existe pas déja
    $requete="select * from visiteur";
    $requete=$requete." where VIS_MATRICULE = '".$mat."';"; 
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if($ligne)
    {
       // Créer la requête d'ajout 
       $requete="delete from visiteur";
       $requete=$requete." where VIS_MATRICULE ='".$mat."';";
       
        // Lancer la requête d'ajout 
        $ok=$connexion->query($requete);
        if ($ok)
        {
          $message = "Le visiteur a été correctement supprimé";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la suppression du visiteur a échoué !";
          ajouterErreur($tabErr, $message);
        } 
    }
    else
    {
      $message="Echec de la suppression !";
      ajouterErreur($tabErr, $message);
        // Si la requête a réussi
      
    }
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "problème à la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}

function rechercher($mat, &$tabErr)
{
 // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
    
    // Vérifier que le matricule saisie n'existe pas déja
    $requete="select * from visiteur";
    $requete=$requete." where VIS_MATRICULE = '".$mat."';"; 
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if($ligne)
    {     

          $visitor['mat']=$ligne->VIS_MATRICULE;
          $visitor['Nom']=$ligne->VIS_NOM;
          $visitor['Prenom']=$ligne->VIS_PRENOM;
          $visitor['adresse']=$ligne->VIS_ADRESSE;
          $ligne=$jeuResultat->fetch();
      
    }
    else
    {
      $message="Echec de l'ajout : le matricule n'existe pas déjà !";
      ajouterErreur($tabErr, $message);    
     }
     }
       $jeuResultat->closeCursor();   // fermer le jeu de résultat
  // deconnecterServeurBD($idConnexion);
  return $visitor;

}    
function modifier($MAT, $nom, $Prenom, $Ad,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
    
    // Vérifier que le matricule saisie n'existe pas déja

      // Créer la requête d'ajout 
       $requete="UPDATE `GSB`.`visiteur` SET `VIS_NOM` = '$nom',
    `VIS_PRENOM` = '$Prenom',
    `VIS_ADRESSE` = '$Ad'
     WHERE `visiteur`.`VIS_MATRICULE`='$MAT';";

         
      
       
        // Lancer la requête d'ajout 
        $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
       
        // Si la requête a réussi
        if ($ok)
        {
          $message = "Le visiteur a été correctement modifié";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la modification du visiteur a échoué !!!";
          ajouterErreur($tabErr, $message);
        } 

    
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "problème à la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}
   
?>
