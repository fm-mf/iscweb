$().ready(function(){
    $("#landing-page").children(".more").click(function(){
        $("body").stop().animate({scrollTop:parseInt(window.getComputedStyle($("#landing-page")[0], null).height)}, 500, 'swing', function() {
        });
    });
});