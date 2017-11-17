<?php include 'connectBase.php'; ?>
<!DOCTYPE html>
<html>
<head>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

     <script type="text/javascript" src="js/monJS.js"></script>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <script type="text/javascript" src="js/tether.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
   
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
     <!-- Template styles -->
    <style rel="stylesheet">
        /* TEMPLATE STYLES */
        /* Necessary for full page carousel*/

        html,
        body {
            height: 100%;
        }
        /* Navigation*/

        .navbar {
            background-color: #304a74;
        }

        .top-nav-collapse {
            background-color: #304a74;
        }

        footer.page-footer {
            background-color: #304a74;
        }

        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #304a74;
            }
        }

        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }
        /* Carousel*/

        .carousel {
            height: 50%;
        }

        @media (max-width: 776px) {
            .carousel {
                height: 100%;
            }
        }
        .card {
            margin-left: 35%;
        }
        .carousel-item,
        .active {
            height: 100%;
        }

        .carousel-inner {
            height: 100%;
        }
        /*Caption*/

        .flex-center {
            color: #fff;
        }
        .navbar .btn-group .dropdown-menu a:hover {
            color: #000 !important;
        }
        .navbar .btn-group .dropdown-menu a:active {
            color: #fff !important;
        }
    </style>
<script>function validerMdp() {
if (document.monForm.password.value != document.monForm.passverif.value) {
document.getElementById("msg").innerHTML = "les deux mots de passe doivent être identiques";

return false;

}

if (document.monForm.password.value.length < 6) {

document.getElementById("msg").innerHTML = "le mot de passe doit comporter au moins 6 caractères";

return false;

}

return true;

}
</script>
</head>
<body>
<?php 

if (isset($_SESSION['userName'])) {
	unset($_SESSION['userName']);
}
?>
<!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">New World</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Acheter <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Distribuer</a>
                    </li>
                        
                </ul>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="text" placeholder="Rechercher" aria-label="Rechercher">
                </form>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Connexion</a>  
                    </li>
                </ul>
            </div>
        </div>
    </nav>
 <!--/.Navbar-->

<br><br><br>
<form method="GET" action="inscriptionNW.php" name="monForm" onsubmit="return validerMdp()">
	<div class="card col-xs-12 text-center col-lg-3 offset-1" id="Changement">
		<h2>Inscription</h2>
			<label for="userName">Nom</label><input type="text" name="userName"><br>
            <label for="userSurname">Prenom</label><input type="text" name="userSurname"><br>
			<label for="mail">Adresse mail</label><input type="email" name="mail"><br>
            <label for="adresse">Adress</label><?php include 'genereInputAdresse.php';?>
            <label for="QS">Question secrète</label><select name="QS" id="QS"><!-- Affichage des questions avec une requete sql -->
            <?
                require_once "connectBase.php";
                if (($cnx = connectionBDD()) === false) exit;
                $resultat = $cnx->query('select qsID,Question from QS');
                if(!$resultat){echo "erreur requete"; exit;}
                while($données=mysql_fetch_assoc($resultat))
                {
            
                echo '<option value="'.$données['qsID'].'">'.$données['Question'].'</option>';
                    
                }
                mysql_close($cnx);
            ?>
            </select><br>
            <label for="repQuesSec">Reponse question secrète</label><input type="text" name="repQuesSec"><br>
            <label for="userRole">Votre rôle</label>
            <div>
                Producteur    <input type="radio" name="role" value="Producteur"><br>
                Consommateur<input type="radio" name="role" value="Consommateur"><br>
                Point relais  <input type="radio" name="role" value="Point relais"><br>
            </div>
			<label for="password" >Mot de passe</label><input type="password" name="password"><br>
			<label for="passverif">Vérification du mot de passe</label><input type="password" name="passverif"><br>
			<button type="submit" name="btnIns" style="background:none; border:0px;">Valider</button>
			<a onclick="Connexion()">Déjà inscrit?</a>
	
	</div>
	<div id="msg"></div>
</form>

<!--Footer-->
<footer class="page-footer center-on-small-only">

<!--Footer Links-->
<div class="container-fluid">
    <div class="row">
        <hr class="w-100 clearfix d-sm-none">

        <!--Second column-->
        <div class="col-lg-2 col-md-4 offset-md-2">
            <h5 class="title font-bold mt-3 mb-4">Participer</h5>
            <ul>
                <li><a href="#!">Proposer des produits</a></li>
                <li><a href="#!">Transformer</a></li>
                <li><a href="#!">Devenir client</a></li>
                <li><a href="#!">Distribuer</a></li>
            </ul>
        </div>
        <!--/.Second column-->

        <hr class="w-100 clearfix d-sm-none">

        <!--Third column-->
        <div class="col-lg-2 col-md-4 offset-md-2">
            <h5 class="title font-bold mt-3 mb-4">Comprendre</h5>
            <ul>
                <li><a href="#!">Savoir faire local</a></li>
                <li><a href="#!">Reduire les transports</a></li>
                <li><a href="#!">Produit frais</a></li>
                <li><a href="#!">Qualité</a></li>
            </ul>
        </div>
        <!--/.Third column-->

        <hr class="w-100 clearfix d-sm-none">

        <!--Fourth column-->
        <div class="col-lg-2 col-md-4 offset-md-2">
            <h5 class="title font-bold mt-3 mb-4">Communiquer</h5>
            <ul>
                <li><a href="#!">Les secrets des producteurs</a></li>
                <li><a href="#!">Le savoir faire des artisans</a></li>
                <li><a href="#!">Les recettes de grand-mère</a></li>
                <li><a href="#!">La conservation des aliments</a></li>
                <li><a href="nousContacter.php">Nous Contacter</a></li>
            </ul>
        </div>
        <!--/.Fourth column-->

    </div>
</div>
<!--/.Footer Links-->
<div id="Changement2" style="display: none">
        <div class="topCentre sizeBandeau1 border2 bg1 box2 centrage"> 
            <h2>Connexion / Déconnexion</h2>
        </div>
        <form method="get" action="connexionNewWorld.php">
            <div>
            
                    <label for="username">Identifiant: </label><input type="text" name="username"><br>
                    <label for="password">Mot de passe: </label><input type="password" name="password"><br>
                    <button type="submit" name="btnCo">Valider</button><br>
                    

            </div>
        </form>
</div> 
<?php
class userName {
	private $userName;
	private $password;
	private $mail;
    private $adresse;
    private $role;
    private $repQuesSec;

	
	public function userName($userName=null,$mail=null,$password=null,$adresse=null,$role=null,$repQuesSec=null) {
		$this->userName = $userName;
		$this->mail = $mail;
		$this->password = $password;
        $this->adresse = $adresse;
        $this->role = $role;
       // $this->quesSec = $quesSec;
        $this->repQuesSec = $repQuesSec;
	} 
	public function getUserName() {
		return $this->userName;
	}
	public function setUserName($userName) {
		$this->userName = $userName;
	}
	public function getMail() {
		return $this->mail;
	}
	public function setMail($mail) {
		$this->mail = $mail;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
    public function getAdresse() {
        return $this->adresse;
    }
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }
   /* public function getQuesSec() {
        return $this->quesSec;
    }
    public function setQuesSec($quesSec) {
        $this->quesSec = $quesSec;
    }*/
    public function getRepQuesSec() {
        return $this->repQuesSec;
    }
    public function setRepQuesSec($repQuesSec) {
        $this->repQuesSec = $repQuesSec;
    }
	public function toString() {
		return $this->userName."(".$this->mail.")";
	}
	public function toBase() {
		require_once "connectBase.php";
		
		if (($cnx = connectionBDD()) === false) exit;
			
		$req = "INSERT INTO `utilisateur`(`userMail`,`userNom`,`userMdp`,`userAdresse`,`userRole`,`userRepQuesSec`) 
		VALUES ('$this->mail','$this->userName','$this->password','$this->adresse','$this->role','$this->repQuesSec');";
			
		$result = $cnx->query($req) or die("La requête \"$req\" a échoué : ".$cnx->error);	
		
		// on ferme la connexion
		mysqli_close($cnx);
	}
}
function mailVerif() {
		$destinataire=$_GET['mail'];
		$sujet="Vérification du mail pour l'inscription sur NewWorld";
		$message="Bonjour,merci de vous être enregistre sur notre magnifique site!Cliquez sur le lien suivant pour confirmer votre inscription  http://localhost/~tjouffreau/NW/nwTemplate/half-page-carousel/inscriptionNW.php?cle=1&btnIns=#";
		mail($destinataire,$sujet,$message);
		echo "Mail envoyé";
	}
    echo"1";
		if(!isset($_REQUEST['btnIns'])) exit;

	echo "<div class=\"centreLeft box1 border2 size4a bg1 border2 overAuto\">";	
    echo"2";
	// récupération des données du formulaire
	$userName = $_REQUEST["userName"];
	$mail = $_REQUEST["mail"];
	$password = $_REQUEST["password"];
    $adresse = $_REQUEST["adresse"];
    $role = $_REQUEST["role"];
    //$quesSec = $_REQUEST["quesSec"];
    $repQuesSec = $_REQUEST["repQuesSec"];
	// création de l'objet
	$_SESSION["UserName"] = new userName($userName,$mail,$password,$adresse,$role,$repQuesSec);
    $cle = 0;
	mailVerif();

			// enregistrement
 // Enregistrer l'utilisateur puis dans la bdd passer le verif mail a true quand il le vvalide
    
        $_SESSION["UserName"]->toBase();
        echo "enregistrement du client : ".$UserName->toString();
        echo "</div>";
 

?>
    <script>
        new WOW().init();
    </script>

</body>
</html>