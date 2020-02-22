<template>
  <!-- NAVBAR -->
  <header class="site-navbar mt-3" id="top">
    <div class="container">
      <div class="row align-items-center">
        <div class="site-logo col-6">
          <router-link to="/" title="Home">Events</router-link>
        </div>

        <nav class="ml-auto site-navigation">
          <ul class="site-menu js-clone-nav d-none d-lg-block">
            <li>
              <router-link to="/" title="Home" class="nav-link active">Home</router-link>
            </li>
            <li v-if="logged" class="has-children">
              <a href="#">
                <img
                  :src="`/img/avatars/${user.avatar}`"
                  alt="Profile Image"
                  class="img-fluid rounded-circle mr-1"
                  width="40"
                  height="40"
                />
                {{ user.first_name }} {{ user.last_name }}
              </a>
              <ul class="dropdown">
                <li>
                  <router-link to="/profile" title="Profile">
                    <i class="fad fa-id-card mr-2"></i>Profile
                  </router-link>
                </li>
                <li>
                  <a href="/admin/#/" title="Administration">
                    <i class="fad fa-user-shield mr-2"></i>Administration
                  </a>
                </li>
                <li>
                  <a href="#" title="Logout" v-on:click="logout">
                    <i class="fad fa-sign-out mr-2"></i>Sign Out
                  </a>
                </li>
              </ul>
            </li>
            <li v-if="!logged">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">
                <strong>Sign In</strong>
              </a>
            </li>

            <li v-if="!logged">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#registerModal">
                <strong>Register</strong>
              </a>
            </li>
          </ul>
        </nav>

        <header-login v-if="!logged"></header-login>
        <header-register v-if="!logged"></header-register>
        <header-recover></header-recover>

        <div class="col-6 site-burger-menu d-block d-lg-none text-right mt-2">
          <a href="#" class="site-menu-toggle js-menu-toggle">
            <span class="far fa-bars h3"></span>
          </a>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import headerLogin from "../authComponents/loginComponent";
import headerRegister from "../authComponents/registerComponent";
import headerRecover from "../authComponents/recoverPasswordComponent";
import User from "../../../classes/user.js";

export default {
  data: function() {
    return {
      user: new User(),
      logged: false
    };
  },
  components: {
    "header-login": headerLogin,
    "header-register": headerRegister,
    "header-recover": headerRecover
  },
  methods: {
    getUser: function() {
      axios.get("/api/user").then(response => {
        this.logged = true;
        this.user.parse(response.data);
      });
    },
    logout: function() {
      axios.post("/api/logout", null).then(response => {
        localStorage.removeItem("access_token");
        window.location.href = "/";
        this.logged = false;
      });
    }
  },
  created: function() {
    if (localStorage.getItem("access_token") != null) {
      this.getUser();
      this.logged = true;
    }
  }
};
</script>
