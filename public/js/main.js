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

	// DETAILS - COMMENTAIRES
	$( document ).ready(function() {
    
    initUIEvents();
    
});

function initUIEvents() {
    
    $(".comment").unbind().click(function(){
        
        var currentComment = $(this).data("commentid");      

        $("#commentactions-" + currentComment).slideDown("fast");
        
    });

    
    $(".commentLi").hover(function(){

        var currentComment = $(this).data("commentid");
            
        $("#comment-" + currentComment).stop().animate({opacity: "1", backgroundColor: "#f8f8f8", borderLeftWidth: "4px"},{duration: 100, complete: function() {}} );     
        
    }, function () {
        
        var currentComment = $(this).data("commentid");
            
        $("#comment-" + currentComment).stop().animate({opacity: "1", backgroundColor: "#fff", borderLeftWidth: "1px"},{duration: 100, complete: function() {}} );   
        
        $("#commentactions-" + currentComment).slideUp("fast");

    });
    
}
});


                