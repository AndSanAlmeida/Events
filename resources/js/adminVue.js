require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

window.Vue = require("vue");

axios.defaults.headers.common["Accept"] = "application/json";
axios.defaults.headers.common["Authorization"] = localStorage.getItem(
    "access_token"
);

// FIXED
Vue.component(
    "admin-layout",
    require("./components/adminComponents/layoutComponent.vue").default
);

// CONST
const home = Vue.component(
    "home",
    require("./components/adminComponents/homeComponent.vue").default
);

// ROUTES
const routes = [
    { path: "/", redirect: "/home" },
    { path: "/home", component: home }
];

const router = new VueRouter({
    routes: routes
});

new Vue({
    router
}).$mount("#admin");
