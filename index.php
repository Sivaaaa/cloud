<!doctype html>
<html>
	<head>
		<title>Cloud</title>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=iso-8859-1" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" type= "text/css" href="css/form.css" />
		<link rel="stylesheet" type= "text/css" href="css/cloud.css" />
		<link rel="stylesheet" type="text/css" href="css/editer_doc.css">

		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
  <body>
    	<div class="message">Bienvenu sur Aya</div>

    <?php 

  session_start();
  $_SESSION['cloud_directory']="/cloud/";   // Your cloud folder
    
  require ('cloud/cloud.php'); ?>

  </body>
</html>



<script type="text/javascript">


//////////////////////////////////////////////////////////////////////////////////////// js /////////////////////////////////////////////////

var timeout1, timeout2
function afficherMessage(message){
	if(message){
    
    $('.message').clearQueue().finish();
    clearTimeout(timeout1);
    clearTimeout(timeout2);
		$('.message').text(message);
		$(".message").animate(  {'top': '0px'},500);
    timeout1 = setTimeout("$('.message').animate(  {'top': '-200px'},400);",'2000');
		timeout2 = setTimeout("$('.message').text(''); $('.message').css('top', '-70px');",'2400');
	}
}

function ConfirmBox(message, yesCallback, noCallback) {
    $('.message').html(message);
	$('.message').append( "<br><button id='btnYes'>Oui</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id='btnNo'>Non</button>" )
	$(".message").animate(  {'top': '0px'},00);
    var dialog = $('#modal_dialog').dialog();

    $('#btnYes').click(function() {
        dialog.dialog('close');
        yesCallback();
		  $('.message').animate(  {'top': '-200px'},40);
		  $('.message').text(''); 
		  $('.message').css('top', '-70px');
    });
    $('#btnNo').click(function() {
		  $('.message').animate(  {'top': '-200px'},400);
		  setTimeout("$('.message').text(''); $('.message').css('top', '-70px');",'400');
    });
}

function PromptBox(message, yesCallback) {
    $('.message').html(message);
	$('.message').append( "<br><input id='PromptBox' class='PromptBox' type='text'>" )
	$('.message').append( "<br><button id='btnYes'>Valider</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id='btnNo'>Annuler</button>" )
	$(".message").animate(  {'top': '0px'},00);
    var dialog = $('#modal_dialog').dialog();
    document.getElementById("PromptBox").focus(); 

    $('#btnYes').click(function() {
        dialog.dialog('close');
        yesCallback();
		  $('.message').animate(  {'top': '-200px'},40);
		  $('.message').css('top', '-70px');
    });
    $('#btnNo').click(function() {
		  $('.message').animate(  {'top': '-200px'},400);
		  setTimeout("$('.message').text(''); $('.message').css('top', '-70px');",'400');
    });
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function caracteres_special(f){
	f = f.replace(/'/g, '\'');
	//f = f.replace(/ /g, '%20'); 
	return f;
}


function cleanHTML(input) {
  // 1. remove line breaks / Mso classes
  var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g; 
  var output = input.replace(stringStripper, ' ');
  // 2. strip Word generated HTML comments
  var commentSripper = new RegExp('<!--(.*?)-->','g');
  var output = output.replace(commentSripper, '');
  //var tagStripper = new RegExp('<(/)*(strong|html|body|div|object|img|ol|ol|li|ul|fieldset|form||tfoot|thead|th|td|menu|output|audio|video|pre|t|code|meta|link|span|\\?xml:|st1:|o:|font)(.*?)>','gi');
  var tagStripper = new RegExp('<(/)*>','gi');
  // 3. remove tags leave content if any
  output = output.replace(tagStripper, '');
  // 4. Remove everything in between and including tags '<style(.)style(.)>'
  var badTags = ['style', 'script','applet','embed','noframes','noscript'];
  
  for (var i=0; i< badTags.length; i++) {
    tagStripper = new RegExp('<'+badTags[i]+'.*?'+badTags[i]+'(.*?)>', 'gi');
    output = output.replace(tagStripper, '');
  }
  // 5. remove attributes ' style="..."'
  var badAttributes = ['style', 'start'];
  for (var i=0; i< badAttributes.length; i++) {
    var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"','gi');
    output = output.replace(attributeStripper, '');
  }
  return output;
}

</script>