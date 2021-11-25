$(document).ready(function(){
    $('#location').click(function(){
        $('#edit-location').css({
            "opacity":"1", "pointer-events":"auto"
        });
        $('#maincontent-container').css({
            "filter":"blur(4px)"
        });
    });
    $('#finish-button').click(function(){
        $('#edit-location').css({
            "opacity":"0", "pointer-events":"none"
        });
        $('#maincontent-container').css({
            "filter":"blur(0px)"
        });
    });
});