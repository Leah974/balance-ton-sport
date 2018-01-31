$(document).ready(function(){

	// PROFIL - MENU
	
	$('#toggle-profil-down').hide();
	
	$("#toggle-profil-up").click(function() {
		$('#profil-nav-item').slideUp();
		$('#toggle-profil-up').hide();
		$('#toggle-profil-down').show();
	});

	$("#toggle-profil-down").click(function() {
		$('#profil-nav-item').slideDown();
		$('#toggle-profil-down').hide();
		$('#toggle-profil-up').show();
	});

});


                