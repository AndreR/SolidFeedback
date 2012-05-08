<?php
mysql_connect("localhost","solidfeedback","solidasarock") or die("Die Datenbankverbindung konnte nicht hergestellt werden");
mysql_select_db("solidfeedback_") or die ("Die Datenbank existiert nicht.");
mysql_set_charset('utf8');
?>