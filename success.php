<?php
require_once('members/members.php');
require_once('include/ticket.php');

$header  = "From: SolidFeedback <noreply@solidfeedback.de>" . "\r\n";
$header .= 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

function getHtmlHead($title) {
	return "
	<html>
	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>$title</title>
	</head>
	<body>
	";
}

function getHtmlFoot() {
	return '</body></html>';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>SolidFeedback – Ticket erfolgreich abgesendet.</title>
<link href="screen.css" rel="stylesheet" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
<?php
$ticket = new Ticket();

// Datenaufbereitung
$ticket->contactName = $_POST['KontaktName'];
$ticket->contactEmail = $_POST['KontaktEmail'];
$ticket->contactTelefon = $_POST['KontaktTelefon'];
$ticket->contactWiki = $_POST['KontaktWiki'];
$ticket->contactTwitter = str_replace('@', '', $_POST['KontaktTwitter']);
$ticket->contactSonstige = $_POST['KontaktSonstige'];
$ticket->concernedPerson = $_POST['Betreffender'];
$ticket->matter = $_POST['Verhalten'];
$ticket->issue = $_POST['WasGestoert'];
$ticket->betterSolution = $_POST['VerhaltenStatdessen'];
$ticket->rectification = $_POST['VerhaltenJetzt'];
$ticket->isPublic = ((isset($_POST['Oeffentlich']) && $_POST['Oeffentlich'] == 'Veroeffentlichen') ? true : false);

// Push to database
//$ticket->pushToDatabase();

// E-Mail-Versand
$email = getMemberEmailByName($ticket->concernedPerson);
$text = getHtmlHead('Neues SolidFeedback-Ticket').$ticket->serializeAsEmail().getHtmlFoot();
mail($email, '=?UTF-8?B?'.base64_encode('Neues SolidFeedback-Ticket').'?=', $text, $header);

//Ausgabe
$outputText = $ticket->getOutputStatement();
echo "<header><h1>Herzlichen Dank!</h1></header>
<div class=\"center\">
<p>$outputText</p>
<p><a href=\"javascript:history.back(-1)\">Zurück zum Formular</a></p>
</div>";
?>
</body>
</html>