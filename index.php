<?php

	include('inc/db_connect.php');
	// select statement, get a random match from basketball table
	//check to see if they have voted on it. if they have, get a different one.
	//if htey haven't then use it.
	//go back to step one.

	//Once they click on vote button, we need to make an AJAX call, to update the database...
	//INSERT statement....that will add their vote to the vote table.  We will need the MID and 
	//the team
	//we will need to set a  session variable for that game
	// we then need to make an ajax call to get all votes for that MID, do the math.
	//replace the content in that div

	//next button, start over.
	$query = "SELECT * FROM football";
	$result = mysql_query($query);
	$index = 0;
	while ($row = mysql_fetch_assoc($result)){
		$team = $row["team"];
		$teams[$index] = $team;
		$index++;
	}
	//this a test value for the while loop below.  It makes sure a user
	//has not already voted on a combination
	$x = true;
	$query = "SELECT * FROM user";
	$result = mysql_query($query);
	$numRows = mysql_num_rows($result);
	$possibleCombinations = 6;
	if($numRows < $possibleCombinations){
		while($x){
			$rand1 = rand(0, count($teams)-1);
			$rand2 = $rand1;
			while($rand1 == $rand2){
				$rand2 = rand(0, count($teams)-1);
			}
			$arrayToSort = array($teams[$rand1], $teams[$rand2]);
			sort($arrayToSort);
			$teamMatch = $arrayToSort[0] . $arrayToSort[1];
			$query2 = "SELECT * FROM user WHERE mid = '$teamMatch'";
			$result2 = mysql_query($query2);
			if(mysql_num_rows($result2)==0){
				$x = false;
			}else{
				$x = true;
			}
		}
	}else{
		print "No more combinations";
	}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="scripts.js"></script>
</head>
<body>

<div id="total-wrapper">
	<h1> Who would win?
	<hr/>

	<div class="team1">
		<?php 
			print "<img src='images/" . $teams[$rand1] . ".png'>";
		?>
	</div>

	<div class="team2">
		<?php 
			print "<img src='images/" . $teams[$rand2] . ".png'>";
		?>
	</div>
	<div class="votes">
		<h3>Votes: </h3>
		<button class="vote" teamid="<?php print $teams[$rand1]; ?>" oppid="<?php print $teams[$rand2]; ?>">
		<?php print $teams[$rand1]; ?></button>
	</div>
	<div class="votes">
		<h3>Votes: </h3>
		<button class="vote" teamid="<?php print $teams[$rand2]; ?>" oppid="<?php print $teams[$rand1]; ?>">
		<?php print $teams[$rand2]; ?></button>
	</div>

	<button>Next</button>
</h1>
</body>
</html>