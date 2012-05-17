<?php
if(stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml"))
	header("Content-Type: application/xhtml+xml");
else
	header("Content-Type: text/html; charset=utf-8");
header("Vary: Accept");
header("Expires: 0");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
<head>
<meta charset="utf-8" />
<title>SolidFeedback [Beta]</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" media="handheld, screen" href="styles/core.css" />
<link rel="stylesheet" media="handheld, only screen and (max-device-width:480px)" href="styles/handheld.css" />
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
<script src="scripts/members.js"></script>
</head>
<body>
<h1><span lang="en" xml:lang="en">SolidFeedback</span> <span class="beta">[Beta]</span></h1>

<div class="wrapping">
<form action="success.php" method="post" name="SF">
<p>Ich ärgere mich über das/störe mich am Verhalten folgender Person und möchte ihr hierfür <span lang="en" xml:lang="en">Feedback</span> geben:</p>
<p class="members"><select id="members" name="Betreffender" size="1" tabindex="10">
<?php
require_once('include/members.php');
foreach(getMemberList() as $member) {
	$name = $member->vorname . " " . $member->name;
	echo "<option";
	if(isset($_GET['to']) && $_GET['to'] == $name)
		echo " selected=\"selected\"";
	echo ">" . htmlspecialchars($name, ENT_QUOTES | ENT_XHTML, 'UTF-8') . "</option>\n";
}
?>
</select></p>

<p class="foobar"><label for="Verhalten">Genaue Beschreibung des Verhaltens, das dich stört/gestört hat:</label><br />
<textarea id="Verhalten" name="Verhalten" placeholder="Bitte beschreibe das Verhalten hier möglichst exakt, so dass auch ein Dritter verstehen kann, was vorgefallen ist. Bitte beschreibe das Verhalten in diesem Feld zuersteinmal neutral und ohne Wertung. Wenn nötig und sinnvoll, gib auch Webquellen etc. an, an denen das Verhalten nachvollzogen werden kann." tabindex="30"></textarea></p>

<p><label for="WasGestoert">Was hat dich an diesem Verhalten genau gestört?</label><br />
<textarea id="WasGestoert" name="WasGestoert" tabindex="40"></textarea></p>

<p><label for="VerhaltenStatdessen">Was für ein Verhalten hättest du dir statt dessen gewünscht?</label><br />
<textarea id="VerhaltenStatdessen" name="VerhaltenStatdessen" tabindex="50"></textarea></p>

<p><label for="VerhaltenJetzt">Welches Verhalten wünscht du dir jetzt von mir?</label><br />
<textarea id="VerhaltenJetzt" name="VerhaltenJetzt" tabindex="60"></textarea></p>

<p>Wie können wir dich erreichen? Lass bitte alle Felder leer, wenn du das Anliegen anonym äußern möchtest.</p>
<div class="contact">
<p><span class="odd"><label for="KontaktName">Wie heißt du?</label><br />
<input type="text" id="KontaktName" name="KontaktName" tabindex="70" /></span></p>
<p><span class="even"><label for="KontaktEmail">E-Mail-Adresse:</label><br />
<input type="email" id="KontaktEmail" name="KontaktEmail" tabindex="80" /></span></p>
<p><span class="odd"><label for="KontaktTelefon">Telefon- oder Handynummer:</label><br />
<input type="tel" id="KontaktTelefon" name="KontaktTelefon" tabindex="90" /></span></p>
<p><span class="even"><label for="KontaktWiki">Benutzername im Piraten-Wiki:</label><br />
<input type="text" id="KontaktWiki" name="KontaktWiki" tabindex="100" /></span></p>
<p><span class="odd"><label for="KontaktTwitter">Twitter-Benutzername:</label><br />
<input type="text" id="KontaktTwitter" name="KontaktTwitter" tabindex="110" /></span></p>
<p><span class="even"><label for="KontaktSonstige">Sonstige Kontaktinformationen:</label><br />
<input type="text" id="KontaktSonstige" name="KontaktSonstige" tabindex="120" /></span></p>
</div>

<p class="foobar"><input type="checkbox" id="Oeffentlich" name="Oeffentlich" value="Veroeffentlichen" tabindex="130" /> <label for="Oeffentlich">Bitte macht mein Anliegen öffentlich.</label></p>

<div class="disclaimer" tabindex="140">
<p>Die angegebenen Informationen werden an die ausgewählte Person versendet, bzw. an ein von ihm für diese Funktion ausgewähltes Team. Die Informationen werden vertraulich behandelt. Sollten sämtliche Kontaktfelder leer bleiben, erfolgt der gesamte Vorgang anonym.</p>
<p>Wenn du das untere Feld „Bitte macht mein Anliegen öffentlich“ auswählst, wird dein Anliegen und die Antwort ggf. veröffentlicht. Bei anonymen und/oder beleidigenden, unsachlichen oder in irgendeiner Form diskriminierenden Äußerungen behalten wir uns vor, das Anliegen nicht zu veröffentlichen.</p>
</div>

<p class="submit"><input type="submit" value="Abschicken" tabindex="150" /></p>
</form>

<footer>
<p class="copyright"><a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/de/" tabindex="160"><abbr lang="en" xml:lang="en" title="Creative Commons Attribution-ShareAlike">CC BY-SA</abbr></a> <span class="name">André Reichelt</span>, <span class="name">Johannes Ponader</span>, <span class="name">Alina Friedrichsen</span></p>
</footer>
</div>

</body>
</html>
