$(function() {
            
    var $btn = $('.btn-danger');
    /**tabLength = $btn.length;*/

    $btn.each(function(){ 

            $(this).on('click' , function() {
                        
                var $div = $(this).parent();
                $div.hide();

                var $id = $(this).parent().data("num");
                var $route = $(this).parent().data("url");

                $.ajax({
                        url : $route,
                        type : 'POST',
                        data : {
                            id_alerte : $id
                        },
                        success : function() {
                            var $badge = $('#badge_alertes'),
                                $divAlertes = $('#list-alertes'),
                                $cptAlertes = 0;

                            $cptAlertes = $badge.text();
                            $cptAlertes = $cptAlertes - 1;
                            if ($cptAlertes == 0) {
                                $badge.hide();
                                $divAlertes.html('Vous n\'avez aucune alerte pour le moment')
                            } else {
                                $badge.html($cptAlertes);
                            }
                        },
                        error : function() {
                            
                        }
                });
            })
    });

});   