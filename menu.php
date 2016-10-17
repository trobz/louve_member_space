﻿
<?php require("_php/base.php");
include("baseinfo.php");
 ?>     
<div class="container">
<?php 
$base = $bdd->query('SELECT status FROM members WHERE login =\'' . $_SESSION['login'] . '\'');
$req = $base->fetch();
if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'up_to_date')
	echo ('
  <div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Vous êtes à jour</strong>
  </div>');
  //alert suspended delay unpayed blocked unsuscribed
elseif (isset($req['status']) AND $req['status'] == 2)
	echo ('
  <div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Attention</strong> Vous avez des services en retard.
  </div>');
 
elseif (isset($req['status']) AND $req['status'] == 3)
	echo ('
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alerte</strong> Vous avez été désinscrit, merci de contacter le bureau des membres.
  </div>
</div>');

$basu = $bdd->query('SELECT * FROM urgences WHERE date >= CURDATE() AND datefin <= CURDATE() ORDER BY niveau DESC LIMIT 0, 1');
$ruq = $basu->fetch();
$urgence=false;
if (isset($ruq['info']))
{
	if (isset($ruq['lien']))
	{
		echo ('
		<div class="alert alert-info fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong> '.$ruq['titre'] .' : </strong> <a href="'. $ruq['lien'].'"> '. $ruq['info'].' </a>
		</div>
		</div>');
	}
	else
	{
		echo ('
		<div class="alert alert-info fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$ruq[titre].' : </strong> '. $ruq['info'].'
		</div>
		</div>');
	}
    $urgence=true;
}

?>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#louvenav" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand"><span class="glyphicon glyphicon-heart" style="color:grey"></span></a>
            </div>

            <div class="nav navbar-nav collapse navbar-collapse" id="louvenav">
                <li><a href="participation.php"><span class="glyphicon glyphicon-time" style="color:grey"></span> MA PARTICIPATION</a></li>
             <?php  // <li><a href="#"><span class="glyphicon glyphicon-calendar" style="color:grey"></span> VIE DE LA LOUVE</a></li> 
              //  <li><a href="documents.php"><span class="glyphicon glyphicon-duplicate" style="color:grey"></span> DOCUMENTS</a></li> ?>
				<li><a href="services.php"><span class="glyphicon glyphicon-ok" style="color:grey"></span> SERVICES</a></li>
                <li><a href="http://vps247219.ovh.net:4567/"><span class="glyphicon glyphicon-earphone" style="color:grey"></span> FORUM</a></li>
<?php	
				$bases = $bdd->query('SELECT salarie FROM members WHERE login =\'' . $_SESSION['login'] . '\'');
				$reqs = $bases->fetch();
				if(isset($reqs['salarie']) AND $reqs['salarie'] == 1)
					echo('<li><a href="salaries.php"><span class="glyphicon glyphicon-plus" style="color:grey"></span> GESTION </a></li>');
?>			
<?php	
if($urgence){
  ?>  
	            <li><a href="urgences.php"><span class="glyphicon glyphicon-alert urgences" style="color:grey;"></span> URGENCES</a></li>
 <?php	
                            } 
     ?>           
            </div>
			<?php //-earphone ?>
            <ul class="nav navbar-inverse navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bonjour, <?php 
						echo ($_SESSION['prenom']); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="mesinfos.php">Mes informations</a></li>
                        <li><a href="#">Messages</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>

        </div> 
    </nav>
	
