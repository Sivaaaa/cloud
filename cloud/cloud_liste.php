<?php 
session_start();


$initial_directory = $_SESSION["cloud_directory"];
		  
$allowed_ext = array('png', 'jpg', 'gif', 'pdf', 'mp4', 'avi','m4a', 'mp3','txt','css','js','html','php','h','c','py','sh');


if(isset( $_GET["dossier"]) && $_GET["dossier"])
{
	$dir_name=urldecode($_GET["dossier"]);
	$directory = $initial_directory.$dir_name;
}else{
	$directory = $initial_directory."Accueil"; 
	$dir_name="Accueil";
}
$_SESSION['upload_directory'] = $directory;

if(isset( $_GET["recherche"])) 
{
	$recherche = '#'.$_GET["recherche"]."#i";
}else{
	$recherche = '';
}

$nb_fichier=0;
$dir = scandir($directory) or die($directory.' Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
foreach ($dir as $element) {   	
	if($element != '.' && $element != '..') {

		if(preg_match($recherche, $element) || $recherche==''){ 
			if (!is_dir($directory.'/'.$element)) {

				$fichier[] = $element;
				$extension[$element] = pathinfo($element, PATHINFO_EXTENSION);
				$nb_fichier++;
			}
			else {	$dossier[] = $element;	}
		}
	}
}

$titre = explode('/',$dir_name);
$titre_dir = $titre[sizeof($titre)-1];
$prec_dir = substr($dir_name,0,-strlen($titre_dir)-1);

// **************************************************************************************************************************************************************************

if( strlen($prec_dir)>0 ){
	?>
	<div id="titre_pages" oncontextmenu="return monmenu(this,'titre')">
	<img onclick="afficher_dossier('<?php echo urlencode($prec_dir) ?>')" height="40px" src="img/cloud/precedent.png" style="float:left; cursor:pointer; padding-top:5px;"><?php echo $titre_dir; ?></div>
<?php }else{ ?>
	<div id="titre_pages" oncontextmenu="return monmenu(this,'titre')"><?php echo $titre_dir; ?></div>
<?php } 

if($nb_fichier>20){ ?><div style="position:absolute; z-index:5; top: 5px; right: 30px; padding:4px; background:grey; border-radius:50%;"><?php echo $nb_fichier;?></div><?php } ?>

<br><br><div id="folder_list" align="left"><?php	

	foreach($dossier as $lien){?>

		<fieldset id="case_dir" title="<?php echo $lien ?>" onclick="afficher_dossier('<?php echo urlencode($dir_name."/".$lien) ?>')"  oncontextmenu="return monmenu(this,'<?php echo urlencode($lien); ?>')">
			<img id="img_file" src="img/cloud/dossier.png" >
			<ee id="titre_case"><?php echo $lien; ?></ee>
		</fieldset><?php
	}
?></div><?php
if(!empty($dossier) && !empty($fichier)) {
	echo '<div id="trait"></div>';
}
?><div id="file_list" align="left"><?php

if(!empty($fichier)){
	foreach($fichier as $lien) {

		$ext_connu = 0;
		foreach($allowed_ext as $ext){
			if($extension[$lien]==$ext){
				$ext_connu = 1;
		} }
					
	  ?><fieldset id="<?php if($nb_fichier<100){ echo 'case_file'; }else{ echo 'case_file_allonger'; } ?>" title="<?php echo $lien ?>" <?php if($ext_connu){ ?> onclick="afficher_fichier('<?php echo urlencode($dir_name.'/'.$lien) ?>')" <?php } ?> oncontextmenu="return monmenu(this,'<?php echo urlencode($lien); ?>')"><?php

		if ($extension[$lien]=='pdf'){
				?><img id="img_file" src="img/cloud/pdf.png"><?php
		} else if ($extension[$lien]=='txt'){
				?><img id="img_file" src="img/cloud/txt.png"><?php
		} else if ($extension[$lien]=='c' ){
				?><img id="img_file" src="img/cloud/c.png"><?php
		} else if ($extension[$lien]=='h' ){
				?><img id="img_file" src="img/cloud/h.png"><?php
		} else if ($extension[$lien]=='zip' ){
				?><img id="img_file" src="img/cloud/zip.png"><?php
		} else if ($extension[$lien]=='jpeg' || $extension[$lien]=='jpg' || $extension[$lien]=='gif' || $extension[$lien]=='png' || $extension[$lien]=='JPG' || $extension[$lien]=='PNG'){

			// <img id="img_file" src="cloud/affichage.php?file=<?php echo urlencode($directory.'/'.$lien); ?     \     >">
			?><img id="img_file" src="img/cloud/img.png"><?php

		} else if ($extension[$lien]=='mp3' || $extension[$lien]=='m4a'){
				?><img id="img_file" src="img/cloud/musique.png"><?php
		} else if($extension[$lien]=="webm" || $extension[$lien]=="ogg" || $extension[$lien]=="mp4" || $extension[$lien]=="flv"){ 
				?><img id="img_file" src="img/cloud/video.png"><?php
		} else if($extension[$lien]=="html"){ 
				?><img id="img_file" src="img/cloud/word.png"><?php
		} else {
				?><ee id="img_file"><p><?php echo $extension[$lien]; ?></p></ee><?php
		} 
		?><ee id="titre_case"><?php echo $lien; ?></ee>
	  </fieldset><?php

	}
}
?></div>
