<?
include("connectBase.php");
	$txtReq="select catId as no,catNom as libelle,count(noProduit) as nombre from categorie inner join produit on produit.categorie=categorie.no where noRayon=$_GET['noRayon'] group by no,libelle limit $_GET[page]*3,3";
	$resultat=mysqli_query($base,$txtReq);
	while($tabInfo=mysqli_fetch_assoc($resultat))
	{
		$tabFinal[]=$tabInfo;
	}
	echo json_encode($tabFinal);
?>