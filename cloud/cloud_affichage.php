<?php 
session_start();

$initial_directory = $_SESSION["cloud_directory"];
	  
if(isset( $_GET["file"]))
{
	$file_name = urldecode($_GET["file"]);
	$file = $initial_directory.$file_name;	
} 
$extension = pathinfo($file, PATHINFO_EXTENSION);

if( !isset( $_GET["music"]) ){ ?> 

	<div id="titre_affichage">
		<?php if($extension=='txt' || $extension=='css' || $extension=='php' || $extension=='js' || $extension=='c' || $extension=='ino' || $extension=='h' || $extension=='html' || $extension=='py' || $extension=='sh' ){  
				
			?><button id="bp_editer" style="margin-left:50px;" onclick="cloud_editer('<?php echo urlencode($file_name) ?>')">Editer</button><?php
			}
			echo basename($file, '.'.$extension ); ?>
			<div id="quitter_element" onclick="quitter_cloud_affichage();"></div>
			<div id="agrandir_element" onclick="agrandir_cloud_affichage();"></div>
			<div id="reduire_element" onclick="reduire_cloud_affichage();"></div>
	</div>
	<div id="espace_affichage"><?php


	if($extension=='txt' || $extension=='css' || $extension=='php' || $extension=='js' || $extension=='c' || $extension=='ino' || $extension=='h' || $extension=='py' || $extension=='sh' ){  
		
		$contenu=file_get_contents($file);
		//$contenu = utf8_decode($contenu); 
		?><textarea readonly style="resize: none; width: 94%; min-height: 100%; padding: 1%; background:white;"><?php echo $contenu ?></textarea><?php

	} else if($extension=='html'){
		
		$contenu=file_get_contents($file);
		//$contenu = utf8_decode($contenu); ?>
		<div style="width: 92%; min-height: 100%; padding: 5% 2%; background:white; text-align:left;"><?php echo $contenu ?></div><?php 

	}if($extension=="jpeg" || $extension=="jpg" || $extension=="gif" || $extension=="png" || $extension=="JPG" || $extension=="PNG"){  

		?><img src="cloud/affichage.php?file=<?php echo urlencode($file); ?>" style="max-height:90%; max-width:96%; vertical-align:center;"/><?php
		
	} else if($extension=="pdf"){  
		
		?><object data="cloud/affichage.php?file=<?php echo urlencode($file); ?>" width="96%" height="100%"></object><?php 

	} else if($extension=="webm" || $extension=="ogg" || $extension=="mp4" || $extension=="flv"){  
		
		?><video controls autoplay id="video" src="cloud/affichage.php?file=<?php echo urlencode($file); ?>" style="max-height:90%; max-width:96%; vertical-align:center;" ></video><?php 

	} ?></div><?php

} else { //************************************************************************************************************************************************************************
?>
	
	<div class="cloud_music_lecteur" >
	<NOBR><b id="titre_music_lecteur"><?php echo basename($file, '.'.$extension ); ?></b></NOBR>

		<!--img src="img/cloud/next.png" onclick="afficher_fichier('');" height="40px" style="float:right; cursor: pointer;">
		<img src="img/cloud/previous.png" onclick="afficher_fichier('');" height="40px" style="float:left; cursor: pointer;"-->
    
	  	<div id="quitter_element" style="right:40px;" onclick="quitter_music_lecteur();"></div>
		<div id="reduire_element" style="right:55px;" class="reduire_element_player" onclick="reduire_music_lecteur();"></div>
		
		
		<audio id="audio" controls="controls" autoplay="autoplay" style="box-shadow:  0px 0px 5px 2px #fff" >
			<source src="cloud/affichage.php?file=<?php echo urlencode($file); ?>" ></source>
		</audio>
	<br>
	</div>
<?php } ?>



<style>

.text_affichage{
	width:96%;
	background:white;
	padding: 5% 2%;
	min-height: 100%;
}
::-webkit-scrollbar {
  width: 0;
}
</style>

<style>

.affichageframe{
	border:0;
	height:100%;
	width:96%;
}
.musicframe{
	margin:0;
	padding:0;
	margin-top:5px;
	margin-left:50%;
	height:31px;
	overflow: hidden;
	border:0;
}


</style>


<script type="text/javascript">


$(document).ready(function(){
	setTimeout(function() { $(".musicframe").contents().find("video").attr("style","margin-top:30px;") }, 1);
	setTimeout(function() { $(".musicframe").contents().find("video").attr("style","margin-top:30px;") }, 10);
	setTimeout(function() { $(".musicframe").contents().find("video").attr("style","margin-top:30px;") }, 50);
	setTimeout(function() { $(".musicframe").contents().find("video").attr("style","margin-top:30px;") }, 100);
	setTimeout(function() { $(".musicframe").contents().find("video").attr("style","margin-top:30px;") }, 1000);
});

/*
	var audio = document.getElementById("audio");	// Changer le text en Play si la musique est terminée
		
	if('<?php echo $_GET["volume"] ?>')
		audio.volume = '<?php echo $_GET["volume"] ?>';
	
	audio.addEventListener('ended', function() { 
			suivant('<?php echo $directory_sans_caracteres ?>','<?php echo $nb_element+1; ?>','<?php echo $type_fichier; ?>');
	}, false);
	audio.addEventListener('error', function() { 
			suivant('<?php echo $directory_sans_caracteres ?>','<?php echo $nb_element+1; ?>','<?php echo $type_fichier; ?>');
	}, false);

	var video = document.getElementById("myVideo"); 

	function pausevideo() { 
	    video.pause(); 
	}
	function pauseaudio() { 
	    audio.pause(); 
	}
	
	
	function touche_presser_music(touche){
	
		//alert(touche);
		
	if('<?php echo $type_fichier; ?>'=='music'){
		if(touche==16 ){// 32 = espace
			if(audio.paused)
				audio.play();
			else
				audio.pause();

		}else if(touche==39 )
			suivant('<?php echo $directory_sans_caracteres ?>','<?php echo $nb_element+1; ?>','<?php echo $type_fichier; ?>');
		else if(touche==37 )
			precedent('<?php echo $directory_sans_caracteres ?>','<?php echo $nb_element-1; ?>','<?php echo $type_fichier; ?>');
		else if(touche==38 )
			audio.volume = audio.volume + 0.1
		else if(touche==40 )
			audio.volume = audio.volume - 0.1
	} else {
		if(touche==16 ){// 32 = espace
			if(audio.paused)
				audio.play();
			else
				audio.pause();

		}else if(touche==39 )
			suivant('<?php echo $directory_sans_caracteres ?>','<?php if($nb_element+1==$nb_max){ echo 0; }else{ echo $nb_element+1; } ?>','<?php echo $type_fichier; ?>');
		else if(touche==37 )
			precedent('<?php echo $directory_sans_caracteres ?>','<?php if($nb_element<1){ echo $nb_max-1; }else{ echo $nb_element-1; } ?>','<?php echo $type_fichier; ?>');
	
	}
}*/
</script>