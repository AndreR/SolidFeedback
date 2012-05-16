<?php
require_once('include/dbconnect.php');

class Member {
	var $name;
	var $vorname;
	var $email;
	
	function Member($name, $vorname, $email) {
		$this->name = $name;
		$this->vorname = $vorname;
		$this->email = $email;
	}
}

function getMemberList() {
	$MEMBERS = array();

	$result = mysql_query("SELECT * FROM users ORDER BY Name");
	while($row = mysql_fetch_object($result))
		$MEMBERS[] = new Member($row->Name, $row->Vorname, $row->Email);
		
	return $MEMBERS;
}

function getMemberEmailByName($name) {
	$result = mysql_query("SELECT Email FROM users WHERE concat_ws(' ',Vorname,Name) LIKE '$name'");
	$row = mysql_fetch_object($result);
	return $row->Email;
}
?>