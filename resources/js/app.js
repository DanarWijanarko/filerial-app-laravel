import "./bootstrap";

import { register } from "swiper/element/bundle";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

register();

window.Alpine = Alpine;

Alpine.plugin(collapse);

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    var scrollPosition = window.sessionStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
        window.sessionStorage.removeItem("scrollPosition");
    }
});
