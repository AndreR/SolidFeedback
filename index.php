<?php
if(stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml"))
	header("Content-Type: application/xhtml+xml");
else
	header("Content-Type: text/html; charset=utf-8");
header("Vary: Accept");
header("Expires: 0");

$url = "./";
if(isset($_GET['to']))
	$url = "?to=" . urlencode($_GET['to']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
<head>
<meta charset="utf-8" />
<title><?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
?>Ticket erfolgreich abgesendet - <?php
}
?>SolidFeedback [Beta]</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" media="handheld, screen" href="styles/core.css" />
<link rel="stylesheet" media="handheld, only screen and (max-device-width:480px)" href="styles/handheld.css" />
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
<script src="scripts/main.js"></script>
</head>
<body>

<h1><?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
?>Herzlichen Dank!<?php
} else {
?><span lang="en" xml:lang="en">SolidFeedback</span> <span class="beta">[Beta]</span><?php
}
?></h1>

<div class="wrapping">
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
?>
<p class="success">Dein <span lang="en" xml:lang="en">Feedback</span> wurde an die kritisierte Person weitergeleitet<?php
if(isset($_POST['is_public'])) {
?> und veröffentlicht<?php
}
?>.</p>
<p class="backlink"><a id="backlink" href="<?php echo htmlspecialchars($url, ENT_QUOTES | ENT_XHTML, 'UTF-8'); ?>">Zurück zum Formular</a></p>
<?php
} else {
?>
<form action="<?php echo htmlspecialchars($url, ENT_QUOTES | ENT_XHTML, 'UTF-8'); ?>" method="post">
<p>Ich ärgere mich über das/störe mich am Verhalten folgender Person und möchte ihr hierfür <span lang="en" xml:lang="en">Feedback</span> geben:</p>
<p class="members"><select id="concerned_person" name="concerned_person" size="1">
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

<p class="foobar"><label for="matter">Genaue Beschreibung des Verhaltens, das dich stört/gestört hat:</label><br />
<textarea id="matter" name="matter" placeholder="Bitte beschreibe das Verhalten hier möglichst exakt, so dass auch ein Dritter verstehen kann, was vorgefallen ist. Bitte beschreibe das Verhalten in diesem Feld zuersteinmal neutral und ohne Wertung. Wenn nötig und sinnvoll, gib auch Webquellen etc. an, an denen das Verhalten nachvollzogen werden kann."></textarea></p>

<p><label for="issue">Was hat dich an diesem Verhalten genau gestört?</label><br />
<textarea id="issue" name="issue"></textarea></p>

<p><label for="better_solution">Was für ein Verhalten hättest du dir statt dessen gewünscht?</label><br />
<textarea id="better_solution" name="better_solution"></textarea></p>

<p><label for="rectification">Welches Verhalten wünscht du dir jetzt von mir?</label><br />
<textarea id="rectification" name="rectification"></textarea></p>

<p>Wie können wir dich erreichen? Lass bitte alle Felder leer, wenn du das Anliegen anonym äußern möchtest.</p>
<div class="contact">
<p><span class="odd"><label for="contact_name">Wie heißt du?</label><br />
<input type="text" id="contact_name" name="contact_name" /></span></p>
<p><span class="even"><label for="contact_email">E-Mail-Adresse:</label><br />
<input type="email" id="contact_email" name="contact_email" /></span></p>
<p><span class="odd"><label for="contact_phone">Telefon- oder Handynummer:</label><br />
<input type="tel" id="contact_phone" name="contact_phone" /></span></p>
<p><span class="even"><label for="contact_wiki">Benutzername im Piraten-Wiki:</label><br />
<input type="text" id="contact_wiki" name="contact_wiki" /></span></p>
<p><span class="odd"><label for="contact_twitter">Twitter-Benutzername:</label><br />
<input type="text" id="contact_twitter" name="contact_twitter" /></span></p>
<p><span class="even"><label for="contact_other">Sonstige Kontaktinformationen:</label><br />
<input type="text" id="contact_other" name="contact_other" /></span></p>
</div>

<p class="foobar"><input type="checkbox" id="is_public" name="is_public" value="Veroeffentlichen" /> <label for="is_public">Bitte macht mein Anliegen öffentlich.</label></p>

<div class="disclaimer">
<p>Die angegebenen Informationen werden an die ausgewählte Person versendet, bzw. an ein von ihm für diese Funktion ausgewähltes Team. Die Informationen werden vertraulich behandelt. Sollten sämtliche Kontaktfelder leer bleiben, erfolgt der gesamte Vorgang anonym.</p>
<p>Wenn du das untere Feld „Bitte macht mein Anliegen öffentlich“ auswählst, wird dein Anliegen und die Antwort ggf. veröffentlicht. Bei anonymen und/oder beleidigenden, unsachlichen oder in irgendeiner Form diskriminierenden Äußerungen behalten wir uns vor, das Anliegen nicht zu veröffentlichen.</p>
</div>

<p class="submit"><input type="submit" value="Abschicken" /></p>
</form>

<footer>
<p class="copyright"><a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/de/"><abbr lang="en" xml:lang="en" title="Creative Commons Attribution-ShareAlike">CC BY-SA</abbr></a> <span class="name">André Reichelt</span>, <span class="name">Johannes Ponader</span>, <span class="name">Alina Friedrichsen</span></p>
</footer>
<?php
}
?>
</div>

</body>
</html>
