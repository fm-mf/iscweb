import $ from "jquery";
import jQuery from "jquery";
import Popper from "popper.js";
import "bootstrap";
import Instafeed from "instafeed.js";

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
});

const feed = new Instafeed({
    get: "user",
    userId: "3020077602",
    clientId: "723086ddbfd244c5adb1094981fa7cb2",
    // https://elfsight.com/service/generate-instagram-access-token/
    // clientSecret: "01784b975df94ebe93c194c543217cae",
    accessToken: "3020077602.723086d.866bfcc502904a3387b00bf05070214b",
    limit: 14,
    after() {
        $("#instafeed a").attr("target", "_blank");
    },
    error() {
        $("#instafeed-container").remove();
    },
});
feed.run();

