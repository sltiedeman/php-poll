$( document ).ready(function() {
	$('.vote').click(function(){
		var pick = $(this).attr("teamid");
		var opp = $(this).attr("oppid");
		var totalVotes = $(this).attr("totalvotes");
		totalVotes++;
		var teamOneVotes = $(this).attr("teamonevotes");
		var teamTwoVotes = $(this).attr("teamtwovotes");
		var arrayToSort = [pick, opp];
		arrayToSort.sort();
		if(arrayToSort[0]==pick){
			teamOneVotes++;
		}else{
			teamTwoVotes++;
		}

		var teamOneVotes = (teamOneVotes / totalVotes * 100).toFixed(1);
		var teamTwoVotes = (teamTwoVotes / totalVotes * 100).toFixed(1);
		$.ajax({
	       	url: "process_vote.php", 
	       	type: "post",
	       	data: {pick:pick, opp:opp},
	       	success: function(result){
				// obj = JSON.parse(result);
				// var new_vote = Number(obj.vote);
				// var new_opp = Number(obj.opp);
				// $( "[team-wrapper="+vote+"]" ).html(new_vote+'% of the vote');
				// $( "[team-wrapper="+opp+"]" ).html(new_opp+'% of the vote');
				$("#team1votes").html("Votes: " + teamOneVotes + "%");
				$("#team2votes").html("Votes: " + teamTwoVotes + "%");
				$(".vote").css("display","none");
				$("#next").fadeIn();
	       	}
  	    });			
	});

});