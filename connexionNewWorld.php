<?php include 'connectBase.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="NewWorldCo.css">
</head>
<body id="coco">
<div class="topCentre sizeBandeau1 border2 bg1 box2 centrage"> 
		<h2>Connexion / Déconnexion</h2>
	</div>
<?php
/* 			Utilisateur connecté
 *   déconnexion en supprimant les variables de session
 */
if(isset($_SESSION['username']))
{
	unset($_SESSION['username'], $_SESSION['userid'], $_SESSION['admin']);
	echo "<div class=\"bottomLeft message alignL\">Vous avez été déconnecté</div>";
			echo "<form method='get' action='NewWorld.php'>
			<button type='submit'>Retour</button><br>
			</form>";
}
else
{
	$username = '';

	// Traitement du formulaire 
	if(isset($_REQUEST['btn']))
	{
		echo "<form method='get' action='NewWorld.php'>
			<button type='submit'>Retour</button><br>
			</form>";

	}
	else
	{
		$form = true;
	}
	if($form)
	{
		// affichage éventuel d'un message sil y a lieu
		if(isset($message))	{
			echo '<div class="bottomLeft message alignL">'.$message.'</div>';
		}
		// Affichage du formulaire
?>
	<form method="get" action="connexionNewWorld.php">
		<div>
		
				<label for="username">Identifiant: </label><input type="text" name="username"><br>
				<label for="password">Mot de passe: </label><input type="password" name="password"><br>
				<button type="submit" name="btn">Valider</button><br>

		</div>
	</form> 
<?php
	}
}
	function execReq($req) {
		require_once "connectBase.php";
		
		if (($cnx = connectionBDD()) === false) exit;
			
		//$req = "INSERT INTO `titre`(`libTitre`, `anParution`, `title`) 
		//VALUES ('$this->titre', '$this->an', '$this->title');";
			
		$result = $cnx->query($req) or die("La requête \"$req\" a échoué : ".$cnx->error);	
		
		// on ferme la connexion
		mysqli_close($cnx);
		return $result;
	}
if (isset($_REQUEST["username"])) {
		$nom = $_REQUEST["username"];
	}
	else $nom="";
	if (isset($_REQUEST["password"])) {
		$password=$_REQUEST["password"];
	}
	else $password="";
	if(!isset($_REQUEST['btn'])) exit;
	$req="select identifiant,motdepasse from Client";
	$res=execReq($req);
	foreach ($res as $ligne) {
		if ($ligne[identifiant]==$nom and $ligne[motdepasse]==$password) {
			$_SESSION["username"]=$_REQUEST["username"];		
			$_SESSION["password"]=$_REQUEST["password"];
		}
	}
	if(!isset($_SESSION["username"]))
		echo "Mauvais Identifiant ou Mot de passe";
	
?>


</body>
</html>