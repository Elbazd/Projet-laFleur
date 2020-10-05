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
 


if (count($_POST)==0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  supprimer($unMatricule, $tabErreurs);
}

// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
include($repVues."vSupprimer.php") ;
include($repVues."pied.php") ;
?>
  