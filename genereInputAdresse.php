<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<input type="text" id="idAdresse" name="adresse" class="ui-autocomplete-input" autocomplete="off" value="" required="" placeholder="Adresse">

<script>
//cette fonction se lance quand la Adresse change
//elle met à jour la liste des Adresse commençant par ce qui a été saisi par l'utilisateur
/*function remplirListeDesAdresse()
{
  //recup du debut du code postal de la Adresse
  var debutCodeAdresse=document.getElementById('idAdresse').value;
  if(debutCodeAdresse.length >9)//à partir de dix caractères
  {
	  var dataListeAdresse=document.getElementById('dataListeAdresse');
	  //j'efface toutes les options de la datalist
	   opts = dataListeAdresse.getElementsByTagName('option');
	   while(opts[1]) {
    	dataListeAdresse.removeChild(opts[1]);
}
	  //je cree ma requete vers le serveur php
	  var request = new XMLHttpRequest();
	  // prise en charge des chgts d'état de la requete
	  request.onreadystatechange = function(response) 
	  {
	    if (request.readyState === 4) 
	    {
	      if (request.status === 200) 
	      {
		// j'obtient la reponse au format json et l'analyse on obtient un tableau
		var reponseJson = JSON.parse(request.responseText);
		// pour chaque ligne du tableau.
		var noLigne;
		for(noLigne=0;noLigne<reponseJson.features.length;noLigne++)
		{ 
			// Cree une nouvelle <option>.
			var nouvelleOption = document.createElement('option');
			// on renseigne la value de l'option avec le numéro du produit.
			$(nouvelleOption).val(reponseJson.features[noLigne].properties.label);
			//on affiche aussi le codePostal et la Adresse
			$(nouvelleOption).text(nouvelleOption.value);
			// ajout  de l'<option> en tant qu'enfant de la liste de selection des produits.
			//console.log(nouvelleOption);
			$(dataListeAdresse).append(nouvelleOption);
		}

	       } 
	       else 
	       {
		  // An error occured :(
		  alert("Couldn't load datalist options :(");
	       }
	    }
	  };
	  //recup du debut du code postal de la Adresse
	  var debutCodeAdresse=document.getElementById('idAdresse').value;
	  //formation du texte de la requete
	  var texteRequeteAjax='https://api-adresse.data.gouv.fr/search/?q='+debutCodeAdresse;
	  //je l'ouvre
	  request.open('GET', texteRequeteAjax, true);
	  //et l'envoie
	  request.send();
  }//fin du si + de 10 caractères ont été saisi
}*/

//auto complément de l'adresse ville et code postal
	$("#idAdresse").autocomplete({
	source: function (request, response) {
		$.ajax({

			url: "https://api-adresse.data.gouv.fr/search/?limit=5",
			data: { q: request.term },
			dataType: "json",
			success: function (data) {
				response($.map(data.features, function (item) {
					return { label: item.properties.label, postcode: item.properties.postcode,city: item.properties.city, value: item.properties.label, street: item.properties.street, name: item.properties.name, latitude: item.geometry.coordinates[1],longitude: item.geometry.coordinates[0]};
				}));
			}
		});
	},
	select: function(event, ui) {
		$('#idCP').val(ui.item.postcode);
		$('#idVille').val(ui.item.city);
		if(ui.item.street)
		$('#idRue').val(ui.item.street);
	    else
		$('#idRue').val(ui.item.name);
	    $("#idLatitude").val(ui.item.latitude);
	    $("#idLongitude").val(ui.item.longitude);
	}
});



</script>
<label>Rue</label>
<input type="text" name="rue" id="idRue" placeholder="rue">
<label>CP</label>
<input type="text" name="cp" id="idCP" placeholder="codePostal">
<label>Ville</label>
<input type="text" name="ville" id="idVille" placeholder="ville">
<input type="hidden" name="latitude" id="idLatitude">
<input type="hidden" name="longitude" id="idLongitude">