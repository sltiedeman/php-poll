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
		//get the current vote count and increment the correct one
		if($teamsArray[0] == $team){
			$query = "SELECT team1votes FROM votes WHERE mid = '".$mid."'";
			$voteUpdate = mysql_query($query);
			$row = mysql_fetch_row($voteUpdate);
			$voteUpdate = $row[0] + 1;
			$query = "UPDATE votes SET team1votes=$voteUpdate WHERE mid = '$mid'";
			$result = mysql_query($query);
		}else{
			$query = "SELECT team2votes FROM votes WHERE mid = '$mid'";
			$voteUpdate = mysql_query($query);
			$row = mysql_query($voteUpdate);
			$voteUpdate = $row[0] + 1;
			$query = "UPDATE votes SET team2votes=$voteUpdate WHERE mid = '$mid'";
			$result = mysql_query($query);
		}
		//then update the database
		// $query = "UPDATE votes SET mid"

	}
	$query = "INSERT INTO user (mid, team, team1votes, team2votes) VALUES ('$mid', '$team', '$team1votes', '$team2votes')";
	$result = mysql_query($query);
	if(mysql_error()){
		print mysql_error();
	}else{
		header('Location: http://local-phppoll.com/');
	}

?>