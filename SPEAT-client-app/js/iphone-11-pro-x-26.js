$(document).ready(function(){
    $('#forgotten-link').click(function(){
        $('#first-popup').css({
            "opacity":"1", "pointer-events":"auto", "filter":"blur(0px)"
        });
        $('#blur').css({
            "filter":"blur(4px)"
        });
    });
    $('#no-button').click(function(){
        $('#first-popup').css({
            "opacity":"0", "pointer-events":"none"
        });
        $('#blur').css({
            "filter":"blur(0px)"
        });
    });
    $('#yes-button').click(function(){
        $('#first-popup').css({
            "opacity":"0", "pointer-events":"none"
        });
        $('#second-popup').css({
            "opacity":"1", "pointer-events":"none"
        });
    });
});