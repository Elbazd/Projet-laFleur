<?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Ajouter"
 * @package default
 * @todo  RAS
 */
 
$repInclude = './include/';
$repVues = './vues/';

require($repInclude . "_init.inc.php");
  
$unMatricule=lireDonneePost("mat", "");
$unNom=lireDonneePost("nm", "");
$unPrenom=lireDonneePost("prm", "");
$uneAdresse=lireDonneePost("adrs", "");


if (count($_POST)==0)
{
 // Ligne de commentaire supplémentaire 
  $etape = 1;
}
else
{
  $etape = 2;
  ajouter($unMatricule, $unNom, $unPrenom, $uneAdresse,$tabErreurs);
}

// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
include($repVues."vAjouterForm.php") ;
include($repVues."pied.php") ;
?>
  
