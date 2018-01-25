$(document).ready(function(){


   // SideNav Initialization
	// $("#btn-nav-profil").click(function() {

	// 	$('#profil-nav').animate({ 
	// 		right : "toggle"
	// 	}, "slow");
			
	// });
	
	$('#profil-nav').hide();

	// SideNav Initialization
	$("#btn-nav-profil").click(function() {

		// var largeur = $('#profil-nav').width();

		$('#profil-nav').show();
			
	});

	$("#profil-content").click(function() {

		// var largeur = $('#profil-nav').width();

		$('#profil-nav').hide();
			
	});

});


                