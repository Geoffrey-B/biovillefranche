$(document).ready(function(){

    $('#rech').click(function(e) {
        if ($('#recherche').val() == "") {

            $('#recherche').effect( "bounce", "slow");
            $('#recherche').css( "borderColor", "red");
            $('#recherche').attr( "placeholder", "Ex: fruits, légumes...");
            e.preventDefault();
        }
    })


$('#suppClient').click(function(s) {
    
})
})
