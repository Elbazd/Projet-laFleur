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
if(count($_POST)==1 )
{
  $etape = 2;
  $leVisiteur=rechercher($unMatricule, $tabErreurs);
  if(count($leVisiteur>0) )
  {
  $etape=3;
  }
}

                                                         
// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
if ($etape==1)
{
include($repVues."vRechercherform.php") ; 
}
if ($etape==3)
{
  include($repVues."vRechercher.php") ; 
}
include($repVues."pied.php") ;
?>