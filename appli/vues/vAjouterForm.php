<script type="text/javascript">
//<![CDATA[

function valider(){
 frm=document.forms['formAjout'];
  // si le prix est positif
  if(frm.elements['prix'].value >0) {
    // les données sont ok, on peut envoyer le formulaire    
    return true;
  }
  else {
    // sinon on affiche un message
    alert("Le prix doit être positif !");
    // et on indique de ne pas envoyer le formulaire
    return false;
  }
}
//]]>
</script>

<!--Saisie des informations dans un formulaire!-->
<div class="container">

<form name="formAjout" action="" method="post" onSubmit="return valider()">
  <fieldset>
    <legend>Entrez les données sur l'utilisateur a ajouter </legend>
    <label>Matricule : </label> <input type="text" placeholder="Entrer le matricule …"name="mat" size="10" /><br />
    <label>Nom :</label> <input type="text" name="nm" size="20" /><br />
    <label>Prenom :</label> <input type="text" name="prm" size="20" /><br />
    <label>Adresse :</label> <input type="text" name="adrs" size="10" /><br />
       
  </fieldset>
  <button type="submit" class="btn btn-primary">Ajouter</button>
  <button type="reset" class="btn">Annuler</button>
  <p />
</form>
</div>


