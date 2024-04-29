import "./bootstrap";

import { register } from "swiper/element/bundle";
register();

import Alpine from "alpinejs";
import anchor from "@alpinejs/anchor";
import collapse from "@alpinejs/collapse";
import range from "./alpine/rangeInput";
import datePicker from "./alpine/datePicker";
import watchProviders from "./alpine/watchProviders";

window.Alpine = Alpine;
Alpine.plugin([collapse, anchor]);
Alpine.data("range", range);
Alpine.data("myDatePicker", datePicker);
Alpine.data("watchProviders", watchProviders);
Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    var scrollPosition = window.sessionStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
        window.sessionStorage.removeItem("scrollPosition");
    }
});
