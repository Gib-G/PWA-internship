$(document).ready(function(){
    $('#delivery-button').click(function(){
        $('#delivery-button').css({
            "background-color":"black"
        });
        $('#delivery-button img').css({
            "filter":"invert(100%)"
        });
        $('#delivery-button p').css({
            "color":"white"
        });
        $('#takeaway-button').css({
            "background-color":"#EEEEEE"
        });
        $('#takeaway-button img').css({
            "filter":"none"
        });
        $('#takeaway-button p').css({
            "color":"black"
        });
    });
    $('#takeaway-button').click(function(){
        $('#takeaway-button').css({
            "background-color":"black"
        });
        $('#takeaway-button img').css({
            "filter":"invert(100%)"
        });
        $('#takeaway-button p').css({
            "color":"white"
        });
        $('#delivery-button').css({
            "background-color":"#EEEEEE"
        });
        $('#delivery-button img').css({
            "filter":"none"
        });
        $('#delivery-button p').css({
            "color":"black"
        });
    });
});