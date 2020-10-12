<?php

// MODIFs A FAIRE
// Ajouter en t�tes 
// Voir : jeu de caract�res � la connection

/** 
 * Se connecte au serveur de donn�es                     
 * Se connecte au serveur de donn�es � partir de valeurs
 * pr�d�finies de connexion (h�te, compte utilisateur et mot de passe). 
 * Retourne l'identifiant de connexion si succ�s obtenu, le bool�en false 
 * si probl�me de connexion.
 * @return resource identifiant de connexion
 */
function connecterServeurBD() 
{
    $PARAM_hote='localhost'; // le chemin vers le serveur
    $PARAM_port='3306';
    $PARAM_nom_bd='gsbvincent'; // le nom de votre base de donn�es
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
 * Ferme la connexion au serveur de donn�es.
 * Ferme la connexion au serveur de donn�es identifi�e par l'identifiant de 
 * connexion $idCnx.
 * @param resource $idCnx identifiant de connexion
 * @return void  
 */
function deconnecterServeurBD($idCnx) {

}


function lister($categ)
{
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD � r�ussi
  if (TRUE) 
  {
      
           
      $requete="select * from visiteur";
       
       
       
      
      
      $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

      $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le r�sultat soit r�cup�rable sous forme d'objet     
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
  $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  // deconnecterServeurBD($idConnexion);
  return $fleur;
}


function ajouter($mat, $nm, $prm, $adrs,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD � r�ussi
  if (TRUE) 
  {
    
    // V�rifier que la r�f�rence saisie n'existe pas d�ja
    $requete="select * from visiteur";
    $requete=$requete." where VIS_MATRICULE = '".$mat."';"; 
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le r�sultat soit r�cup�rable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if($ligne)
    {
      $message="Echec de l'ajout : la r�f�rence existe d�j� !";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      // Cr�er la requ�te d'ajout 
       $requete="insert into visiteur"
       ."(VIS_MATRICULE,VIS_NOM,VIS_PRENOM,VIS_ADRESSE) values ('"
       .$mat."','"
       .$nm."','"
       .$prm."','"
       .$adrs."');";
       
        // Lancer la requ�te d'ajout 
        $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
       
        // Si la requ�te a r�ussi
        if ($ok)
        {
          $message = "Le visiteur a �t� correctement ajout�";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, l'ajout du visiteur a �chou� !";
          ajouterErreur($tabErr, $message);
        } 

    }
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "probl�me � la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}


function supprimer($mat,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD � r�ussi
  if (TRUE) 
  {
    
    // V�rifier que la r�f�rence saisie n'existe pas d�ja
    $requete="select * from visiteur";
    $requete=$requete." where VIS_MATRICULE = '".$mat."';"; 
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le r�sultat soit r�cup�rable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if($ligne)
    {
       // Cr�er la requ�te d'ajout 
       $requete="delete from visiteur";
       $requete=$requete." where VIS_MATRICULE ='".$mat."';";
       
        // Lancer la requ�te d'ajout 
        $ok=$connexion->query($requete);
        if ($ok)
        {
          $message = "Le visiteur a �t� correctement supprim�";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la suppression du visiteur a �chou� !";
          ajouterErreur($tabErr, $message);
        } 
    }
    else
    {
      $message="Echec de la suppression !";
      ajouterErreur($tabErr, $message);
        // Si la requ�te a r�ussi
      
    }
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "probl�me � la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}

function rechercher($mat, &$tabErr)
{
 // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD � r�ussi
  if (TRUE) 
  {
    
    // V�rifier que le matricule saisie n'existe pas d�ja
    $requete="select * from visiteur";
    $requete=$requete." where VIS_MATRICULE = '".$mat."';"; 
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le r�sultat soit r�cup�rable sous forme d'objet     
    
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
      $message="Echec de l'ajout : le matricule n'existe pas d�j� !";
      ajouterErreur($tabErr, $message);    
     }
     }
       $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  // deconnecterServeurBD($idConnexion);
  return $visitor;

}    
function modifier($MAT, $nom, $Prenom, $Ad,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD � r�ussi
  if (TRUE) 
  {
    
    // V�rifier que le matricule saisie n'existe pas d�ja

      // Cr�er la requ�te d'ajout 
       $requete="UPDATE `GSB`.`visiteur` SET `VIS_NOM` = '$nom',
    `VIS_PRENOM` = '$Prenom',
    `VIS_ADRESSE` = '$Ad'
     WHERE `visiteur`.`VIS_MATRICULE`='$MAT';";

         
      
       
        // Lancer la requ�te d'ajout 
        $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
       
        // Si la requ�te a r�ussi
        if ($ok)
        {
          $message = "Le visiteur a �t� correctement modifi�";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la modification du visiteur a �chou� !!!";
          ajouterErreur($tabErr, $message);
        } 

    
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "probl�me � la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}
   
?>
