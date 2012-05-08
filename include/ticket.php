<?php
class Ticket {
	var $date;
	var $concernedPerson;
	var $matter;
	var $issue;
	var $betterSolution;
	var $rectification;
	var $contactName;
	var $contactEmail;
	var $contactTelefon;
	var $contactWiki;
	var $contactTwitter;
	var $contactSonstige;
	var $isPublic;
	
	//Constructors
	function Ticket() {
		$this->date = time();
	}
	
	//Properties
	function isAnonymous() {
		return (empty($this->contactName) && empty($this->contactEmail) && empty($this->contactTelefon) && empty($this->contactWiki) && empty($this->contactTwitter) && empty($this->contactSonstige));
	}
	
	//Getter
	function getSenderName() {
		return (!$this->isAnonymous() ? (!empty($this->contactName) ? $this->contactName : 'Namenlos') : 'einer anonymen Person');
	}
	function getFormatedTimestamp() {
		setlocale(LC_ALL, 'de_DE.UTF8');
		return strftime('%A, den %e. %B %Y um %T Uhr', $this->date);
	}
	function getPublishStatement() {
		return 'Der Absender bittet darum, diese Angelegenheit '.($this->isPublic ? '<em>öffentlich</em> zu machen' : '<em>vertraulich</em> zu behandeln').'.';
	}
	function getOutputStatement() {
		return 'Dein Feedback wurde an die kritisierte Person weitergeleitet'.($this->isPublic ? ' und veröffentlicht' : '').'.';
	}
	
	//Serializers
	function serializeAsEmail() {
		$date = $this->getFormatedTimestamp();
		$sender = $this->getSenderName();
		$publishStatement = $this->getPublishStatement();
		
		$content = "<p>Am <em>$date</em> wurde ein neues Ticket über SolidFeedback von <em>$sender</em> für $this->concernedPerson erstellt.</p>
		<p>Wahrgenommenes Verhalten:</p>
		<p>$this->matter</p>
		<hr />
		<p>Anlass des Ärgers:</p>
		<p>$this->issue</p>
		<hr />
		<p>Erwartung:</p>
		<p>$this->betterSolution</p>
		<hr />
		<p>Nun gewünschtes Verhalten:</p>
		<p>$this->rectification</p>
		<hr />
		<p>Kontakt:
		<ul>
		<li><em>Name:</em> $this->contactName</li>
		<li><em>E-Mail:</em> <a href=\"mailto:$this->contactEmail\">$this->contactEmail</a></li>
		<li><em>Telefon:</em> <a href=\"tel:$this->contactTelefon\">$this->contactTelefon</a></li>
		<li><em>Wiki:</em> <a href=\"http://wiki.piratenpartei.de/Benutzer:$this->contactWiki\">$this->contactWiki</a></li>
		<li><em>Twitter:</em> <a href=\"https://twitter.com/#!/$this->contactTwitter\">@$this->contactTwitter</a></li>
		<li><em>Sonstige:</em> $this->contactSonstige</li>
		</ul></p>
		<p>$publishStatement</p>";
		
		return $content;
	}
	
	function pushToDatabase() {
		require_once('dbconnect.php');
		$timestamp = date('Y-m-d H:i:s', $this->date);
		$public = $this->isPublic ? 1 : 0;
		return mysql_query("INSERT INTO tickets (UserID, Timestamp, Matter,Issue, BetterSolution, Rectification, cName, cEmail, cTelefon, cWiki, cTwitter, cSonstiges, public) VALUES ((SELECT UserID FROM users WHERE Name = '$this->concernedPerson'), '$timestamp', '$this->matter', '$this->issue', '$this->betterSolution', '$this->rectification', '$this->contactName', '$this->contactEmail', '$this->contactTelefon', '$this->contactWiki', '$this->contactTwitter', '$this->contactSonstige', $public)");
	}
}
?>