

<!-- Affichage des informations sur les fleurs-->

<div class="container">

    <table class="table table-bordered table-striped table-condensed">
      <caption>
<?php
    if (isset($cat))
    {
?>
        <h3><?php echo $cat;?></h3>
<?php    
    }
?>
      </caption>
      <thead>
        <tr>
          <th>Matricule</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Adresse</th>
          
          
        </tr>
      </thead>
      <tbody>       
        <tr>
            <td><?php echo $leVisiteur["mat"]?></td> 
            <td><?php echo $leVisiteur["Nom"]?></td>
            <td><?php echo $leVisiteur["Prenom"]?></td>
            <td><?php echo $leVisiteur["adresse"]?></td>
        </tr>
   
       </tbody>       
     </table>    
  </div>

 
