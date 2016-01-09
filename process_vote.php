<?php
	
	include('inc/db_connect.php');
	$team = $_POST['pick'];
	$team2 = $_POST['opp'];
	$teamsArray = array($team, $team2);
	sort($teamsArray);
	$mid = $teamsArray[0] . $teamsArray[1];
	// $mid = $_POST['pick'];
	$query = "INSERT INTO votes (mid, team) VALUES ('$mid', '$team')";
	$result = mysql_query($query);
	if(mysql_error()){
		print mysql_error();
	}else{
		header('Location: http://local-phppoll.com/');
	}

?>