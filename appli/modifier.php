<?php
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Ajouter"
 * @package default
 * @todo  RAS
 */
 
$repInclude = './include/';
$repVues = './vues/';

require($repInclude . "_init.inc.php");
  

if (count($_POST)==0)
{
  $etape = 1;
}
else
{
  if (count($_POST)==1)
  {
   $uneMat=lireDonneePost("mat", "");
   $leVisiteur = rechercher($uneMat, $tabErreurs);
    // Si une fleur est trouv�e, on passe � l'�tape suivante
    //var_dump($lafleur);
    if (count($leVisiteur)>0)
    {
      $etape = 2;
    }
    else
    {
      // Aucune fleur n'est trouv�e
      // Afficher un message d'erreur
      $message="Echec de la modification : le visiteur n'existe pas !";
      ajouterErreur($tabErreurs, $message);
      // Revenir � l'�tape 1
      $etape = 1;
    }
     }
  else
  {
    $etape = 3;
    $uneMat=$_POST["Matcache"];
    $unNom=$_POST["Nom"];
    $unPrenom=$_POST["Pre"];
    $uneAdresse=$_POST["Ad"];
    modifier($uneMat, $unNom, $unPrenom, $uneAdresse,$tabErreurs);
    // Message de r�ussite pour l'affichage
    if (nbErreurs($tabErreurs)==0)
    {
      $reussite = 1;
      $messageActionOk = "La fleur a �t� correctement modifi�e";
    }
  }
}

// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
if ($etape==1 )
{
include($repVues."vModifier.php") ;   
}
if ($etape==2)
{
include ($repVues."vModifierForm.php") ; 
}
if ($etape==3)
{
  include($repVues."vAccueil.php");
}
include($repVues."pied.php") ;
?>
  