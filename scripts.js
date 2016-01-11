$( document ).ready(function() {
	$('.vote').click(function(){
		var pick = $(this).attr("teamid");
		var opp = $(this).attr("oppid");
		// console.log(pick);
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
				console.log(result);

	       	}
  	    });			
	});

});