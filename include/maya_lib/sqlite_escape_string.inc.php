<?php

// written by maya 2016.06.22
// sqlite_escape_string for SQLite3

function sqlite_escape_string ($str) {

	$db = null;
	$db = new SQLite3 (':memory:');

	$escape_string = $db -> escapeString ($str);

	$db -> close ();

	return $escape_string;
}
?>
