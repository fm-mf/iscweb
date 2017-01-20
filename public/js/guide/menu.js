function moveLeft($ele) {
	$ele.animate(
		{left:$ele.position().left - $('#left-column').width()},
		300
	);
}

function moveRight($ele) {
	$ele.animate(
		{left: $ele.position().left + $('#left-column').width()},
		300
	);
}

$( document ).ready(function() {
 
	var duration = 300;
	vis = false;
    $( "#menu-button" ).click(function( event ) {
		//!$("#left-column").is(':visible')
		if(vis === false) {
			moveRight($("#left-column"));
			moveRight($("body"));
			vis = true;
			
		} else {
			moveLeft($("#left-column"));
			moveLeft($("body"));
			vis = false;
		}
		event.preventDefault();
    });
 
});