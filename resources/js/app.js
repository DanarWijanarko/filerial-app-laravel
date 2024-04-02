import "./bootstrap";

import { register } from "swiper/element/bundle";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

register();

window.Alpine = Alpine;

Alpine.plugin(collapse);

Alpine.start();
