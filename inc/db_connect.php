<?php
	session_start();
	if(!isset($_SESSION["id"])){
		$rand = md5 (rand());
		$_SESSION["id"] = $rand;
		$_SESSION["newuser"] = true;

	}

	$link = mysql_connect('127.0.0.1', 'phpland', 'test');
	if (!$link) {
	    die('Not connected : ' . mysql_error());
	}

	// make phpland the current db
	$db_selected = mysql_select_db('poll', $link);
	if (!$db_selected) {
	    die ('Can\'t use poll : ' . mysql_error());
	}
?>