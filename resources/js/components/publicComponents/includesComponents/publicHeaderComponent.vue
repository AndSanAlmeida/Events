<template>
  <!-- NAVBAR -->
  <header class="site-navbar mt-3" id="top">
    <div class="container">
      <div class="row align-items-center">
        <div class="site-logo col-6">
          <a href="#">Events</a>
        </div>

        <nav class="ml-auto site-navigation">
          <ul class="site-menu js-clone-nav d-none d-lg-block">
            <li>
              <a href="#" class="nav-link active">Home</a>
            </li>
            <!-- <li class="has-children">
              <a href="#">Pages</a>
              <ul class="dropdown">
                <li>
                  <a href="#">Services</a>
                </li>
              </ul>
            </li>-->
            <li>
              <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">
                <strong>Sign In</strong>
              </a>
            </li>

            <li>
              <a href="#" class="nav-link" data-toggle="modal" data-target="#registerModal">
                <strong>Register</strong>
              </a>
            </li>
          </ul>
        </nav>

        <header-login></header-login>
        <header-register></header-register>

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
import headerLogin from "../authComponents/loginComponent.vue";
import headerRegister from "../authComponents/registerComponent.vue";

export default {
  components: {
    "header-login": headerLogin,
    "header-register": headerRegister
  }
};
</script>
