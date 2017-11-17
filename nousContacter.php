<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Material Design Bootstrap</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
            margin-left: 30%;
            border-style: none;
        }
        .carousel-item,
        .active {
            height: 100%;
        }

        .carousel-inner {
            height: 100%;
        }
        /*Caption*/
        .error {
            color: #FF0000;
        }
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

</head>
<body>
    <?php
      $adressErr=$sujetErr="";
      $adresse=$sujet=$descrip="";

        if (empty($_GET["adresse"]))
         {
            $adressErr="Une adresse est nécessaire";
         }
        else 
        {
            $adresse = $_GET["adresse"];
            
             // check if e-mail address is well-formed
            if (!filter_var($adresse, FILTER_VALIDATE_EMAIL)) 
            {
                $adressErr = "Format d'email invalide";
            }
         }   
        if (empty($_GET["sujet"]))
        {
            $sujetErr="Un sujet est nécessaire";

            }
        else
        {
            $sujet = $_GET["sujet"];
            $sujet = addslashes($sujet);
        }
        $descrip=$_GET["descrip"];
        $descrip= addslashes($descrip);
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
                        <a class="nav-link" href="inscriptionNW.php">Connexion</a>  
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--/.Navbar-->
    <br><br><br>
    <form method="GET" action="nousContacter.php" name="leForm">
        <div class="card col-xs-12 text-center col-lg-4 offset-1">
            <label for="adresse">Adresse mail</label><input type="text" name="adresse"><p class="error">* <?php echo $adressErr;?></p>
            <label for="sujet">Sujet</label><input type="text" name="sujet"><p class="error">* <?php echo $sujetErr;?></p>
            <label for="descrip">Descriptif</label><textarea name="descrip" style="height: 451px"></textarea>
            <button type="submit" name="btnIns" style="background:none; border:0px;">Valider</button>
        </div>
    </form>
    <?php
        $ip=$_SERVER["REMOTE_ADDR"];
        if ($adressErr=="" and $sujetErr=="")
         {
            require_once "connectBase.php";
            if (($cnx = connectionBDD()) === false) exit;
            $req="INSERT INTO contact(adresse,sujet,descriptif,verifTimer,ip) VALUES ('".$adresse."','".$sujet."','".$descrip."','now()','".$ip."');";
            $result = $cnx->query($req) or die("La requête \"$req\" a échoué : ".$cnx->error);  
            
            
            $req="SELECT verifTimer FROM contact WHERE ip='".$ip."' AND now()-verifTimer<30;";
            $result = $cnx->query($req) or die("La requête \"$req\" a échoué : ".$cnx->error); 
            $req="SELECT now()-verifTimer FROM contact WHERE ip='".$ip."' AND now()-verifTimer<30;";
            $res = $cnx->query($req) or die("La requête \"$req\" a échoué : ".$cnx->error); 
            // on ferme la connexion
            mysqli_close($cnx); 
            if ($result)
            {
               echo "Il vous reste encore".$res."avant de pouvoir renvoyer un mail"; 
            }
        }
       
        
     
    ?>
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
    </footer>
    <!--/.Footer-->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/tether.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

    <script>
        new WOW().init();
    </script>

</body>

</html>