$(document).ready(function () {
    SearchBarPosition();    

    var popup = $('.popup');
    if (popup.length > 0)
    {
        popup.popover('show');
        popup.popover('hide');       
    }
});


$(window).bind('resize', function () {
    SearchBarPosition();
}).trigger('resize');

function SearchBarPosition()
{
    var screenWidth = window.innerWidth;
    var margin = Math.max(screenWidth / 2 - 550, 10);
    $('#main-logo').css('margin-right', margin);
}
