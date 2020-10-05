<!--Saisir les informations dans un formulaire!-->
<div class="container">
  <form action="" method=post>
    <input type="hidden" name="etape" value="3" />

    <fieldset>
      <legend>Entrez les données sur la fleur à modifier </legend>
      <label> Matricule :</label>
      <label><?php echo $leVisiteur["mat"]; ?> </label>
      <input type="hidden" name="Matcache" value="<?php echo $leVisiteur["mat"]; ?>" /><br />
      <label>Nom :</label>
      <input type="text" name="Nom" value="<?php echo $leVisiteur["Nom"]; ?>" size="20" /><br />
      <label>Prenom :</label>
      <input type="text" name="Pre" value="<?php echo $leVisiteur["Prenom"]; ?>" size="10" /><br />
      <label>Adresse :</label>
      <input type="text" name="Ad" value="<?php echo $leVisiteur["adresse"]; ?>" size="20"/><br />
    </fieldset>
    <button type="submit" class="btn btn-primary">Modifier</button>
    <button type="reset" class="btn">Annuler</button>
    <p />
  </form> 
</div>



