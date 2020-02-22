<template>
  <div>
    <section class="home-section section-nothero overlay slanted" id="home-section">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-8">
            <h1>Profile</h1>
            <div class="w-75">
              <p class="text-uppercase">
                <router-link to="/home" class="text-uppercase">Home</router-link>
                <span class="d-inline-block mx-2">•</span>
                <router-link to="/profile" class="text-uppercase">Profile</router-link>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- VIDEO -->
      <div class="video-container">
        <video autoplay loop="true">
          <source type="video/mp4" src="videos/video.mp4" />
        </video>
      </div>

      <a href="#next-section" class="scroll-button smoothscroll">
        <span class="far fa-angle-down"></span>
      </a>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 mb-5 mb-lg-0 col-xs-12 text-center">
            <profile-avatar></profile-avatar>
          </div>
          <div class="col-lg-5 col-xs-12">
            <profile-info></profile-info>

            <!-- LINKS -->
            <div class="text-center mt-2">
              <a
                href="#"
                data-toggle="modal"
                data-target="#changePasswordModal"
              >Change Account Password?</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PROFILE CHANGE PASSWORD MODAL -->
    <profile-password></profile-password>
  </div>
</template>

<script>
import profileAvatar from "./profileComponents/avatarComponent";
import profileInfo from "./profileComponents/infoComponent";
import profilePassword from "./profileComponents/changePasswordComponent";

export default {
  components: {
    "profile-avatar": profileAvatar,
    "profile-info": profileInfo,
    "profile-password": profilePassword
  }
};
</script>