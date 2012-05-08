<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>SolidFeedback [Beta]</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<script>
function gup(name) { /* (c) lobo235 – http://www.netlobo.com/url_query_string_javascript.html */
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp(regexS);
	var results = regex.exec(window.location.href);
	if(results == null)
		return "";
	else
		return results[1];
}
</script>
</head>

<body>
<header>
	<section>
		<h1>SolidFeedback <span style="font-size:small; color:silver;">[Beta]</span></a></h1>
	</section>
	<link href="screen.css" rel="stylesheet" type="text/css" media="all" />
</header>

<!--<nav>
	<ul>
		<li></li>
	</ul>
</nav>-->

<section id="main">
<form action="success.php" method="post" name="SF">
	<p>Ich ärgere mich über das/störe mich am Verhalten folgender Person und möchte ihr hierfür Feedback geben:</p>
	<div>
		<img id="MemberPic">
		<select name="Betreffender" size="1" tabindex="10">
			<?php
			require_once('members/members.php');
			foreach(getMemberList() as $member)
				echo "<option>$member->vorname $member->name</option>";
			?>
		</select>
		<a href="http://solidfeedback.de" id="Permanentlink" title="Du kannst diesen Link weitergeben, um direkt auf die ausgewählte Person zu verweisen.">Permanentlink</a>
	</div>
	
	<p>Genaue Beschreibung des Verhaltens, das dich stört/gestört hat:</p>
	<div><textarea name="Verhalten" placeholder="Bitte beschreibe das Verhalten hier möglichst exakt, so dass auch ein Dritter verstehen kann, was vorgefallen ist. Bitte beschreibe das Verhalten in diesem Feld zuersteinmal neutral und ohne Wertung. Wenn nötig und sinnvoll, gib auch Webquellen etc. an, an denen das Verhalten nachvollzogen werden kann." tabindex="20"></textarea></div>
	
	<p>Was hat dich an diesem Verhalten genau gestört?</p>
	<textarea name="WasGestoert" tabindex="30"></textarea>
	
	<p>Was für ein Verhalten hättest du dir statt dessen gewünscht?</p>
	<textarea name="VerhaltenStatdessen" tabindex="40"></textarea>
	
	<p>Welches Verhalten wünscht du dir jetzt von mir?</p>
	<textarea name="VerhaltenJetzt" tabindex="50"></textarea>
	
	<p>Wie können wir dich erreichen? Lass bitte alle Felder leer, wenn du das Anliegen anonym äußern möchtest.</p>
	<div id="PersonalData">
		<input type="text" name="KontaktName" placeholder="Wie heißt du?" tabindex="60" />
		<input type="text" name="KontaktEmail" placeholder="E-Mail-Adresse" tabindex="70" />
		<input type="text" name="KontaktTelefon" placeholder="Telefon- oder Handynummer" tabindex="80" />
		<input type="text" name="KontaktWiki" placeholder="Benutzername im Piraten-Wiki" tabindex="90" />
		<input type="text" name="KontaktTwitter" placeholder="Twitter-Benutzername" tabindex="100" />
		<input type="text" name="KontaktSonstige" placeholder="Sonstige Kontaktinformationen" tabindex="110" />
	</div>
	
	<p><input type="checkbox" id="Oeffentlich" name="Oeffentlich" value="Veroeffentlichen" tabindex="130"><label for="Oeffentlich">Bitte macht mein Anliegen öffentlich.</label></p>
	
	<small tabindex="120">
		<p>Die angegebenen Informationen werden an die ausgewählte Person versendet, bzw. an ein von ihm für diese Funktion ausgewähltes Team. Die Informationen werden vertraulich behandelt. Sollten sämtliche Kontaktfelder leer bleiben, erfolgt der gesamte Vorgang anonym.</p>
		<p>Wenn du das untere Feld „Bitte macht mein Anliegen öffentlich“ auswählst, wird dein Anliegen und die Antwort ggf. veröffentlicht. Bei anonymen und/oder beleidigenden, unsachlichen oder in irgendeiner Form diskriminierenden Äußerungen behalten wir uns vor, das Anliegen nicht zu veröffentlichen.</p>
	</small>
	
	<div id="Buttons"><input name="" type="submit" tabindex="140" /></div>
</form>
</section>

<footer>
	<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/de/">CC-BY-SA</a> André Reichelt, Johannes Ponader
</footer>

<script>
	document.SF.Betreffender.onchange = function() {
		var sp = document.SF.Betreffender.value;
		document.getElementById("MemberPic").src="members/"+sp+".jpg";
		document.getElementById("Permanentlink").href = "http://solidfeedback.de/?an="+sp;
	}
	
	var selectedPerson = gup("an");
	if(selectedPerson != '')
		document.SF.Betreffender.value = unescape(selectedPerson);
	document.SF.Betreffender.onchange();
</script>
</body>
</html>