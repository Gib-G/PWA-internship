$(document).ready(function(){
    $('#published-button').click(function(){
        $('#popup').css({
            "opacity":"1", "pointer-events":"auto", "filter":"blur(0px)"
        });
        $('#maincontent-container').css({
            "filter":"blur(4px)"
        });
    });
});