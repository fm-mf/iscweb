import $ from "jquery";
import jQuery from "jquery";
import "bootstrap";

import "./czech/_instafeed"
import initGMapsPreview from "./czech/_gMapsPreview";

window.jQuery = jQuery;
require("@fancyapps/fancybox");


$(document).ready(() => {
    const navbar_custom = $(".navbar-custom");
    $(".fancybox-media").fancybox({
        iframe: {
            tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen src=""></iframe>',
            // tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen allow="autoplay; fullscreen" src=""></iframe>',
        },
    });
    initGMapsPreview();

    $("#scroll").click((event) => {
        event.preventDefault();
        const href = $(event.currentTarget).attr("href");
        const destination = $(href);
        const position = destination.position().top;
        $("html, body").stop().animate({
            scrollTop: position,
        });
        return false;
    });

    const htmlBody = $("html, body");

    const activitiesDetail = $(".activities-detail");
    if (activitiesDetail.length > 0) {
        htmlBody.stop().animate({
            scrollTop: activitiesDetail.position().top,
        });
    }
});
