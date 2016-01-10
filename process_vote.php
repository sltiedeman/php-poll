<?php
	
	include('inc/db_connect.php');
	$team = $_POST['pick'];
	$team2 = $_POST['opp'];
	$teamsArray = array($team, $team2);
	sort($teamsArray);
	$mid = $teamsArray[0] . $teamsArray[1];
	if($teamsArray[0] == $team){
		$team1votes = 1;
		$team2votes = 0;
	}else{
		$team2votes = 1;
		$team1votes = 0;
	}
	$query = "SELECT * FROM votes WHERE mid = '$mid'";
	$result = mysql_query($query);
	if(mysql_num_rows($result)==0){
		$query = "INSERT INTO votes (mid, team1votes, team2votes) 
				VALUES ('$mid', '$team1votes', '$team2votes')";
		$result = mysql_query($query);
		
	}else{

	}
	$query = "INSERT INTO user (mid, team, team1votes, team2votes) VALUES ('$mid', '$team', '$team1votes', '$team2votes')";
	$result = mysql_query($query);
	if(mysql_error()){
		print mysql_error();
	}else{
		header('Location: http://local-phppoll.com/');
	}

?>