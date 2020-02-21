<template>
  <div
    class="modal fade"
    id="loginModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="loginModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="loginModalLabel">Sign In</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form method="post" v-on:submit.prevent="submitForm">
            <!-- Alert -->
            <div class="alert alert-danger" role="alert" v-cloak v-show="serverError">
              <span>
                <strong class="pr-1">Error:</strong>
                {{serverErrorMessage}}
              </span>
            </div>

            <!-- Email -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="loginEmail">
                  <i class="fad fa-mailbox fa-lg mr-2 text-primary"></i>Email
                </label>
                <input
                  type="email"
                  id="loginEmail"
                  class="form-control"
                  name="email"
                  v-model="email"
                  v-bind:class="{ 'is-invalid': missingEmail  }"
                  placeholder="name@email.com"
                  required
                />

                <!-- Email Error -->
                <div class="text-danger" v-cloak v-show="isFormInvalid && missingEmail ">
                  <span v-if="missingEmail">Email is Missing</span>
                </div>
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="invalidEmail">Invalid Email</span>
                </div>
              </div>
            </div>

            <!-- Password -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="loginPassword">
                  <i class="fad fa-key fa-lg mr-2 text-primary"></i>Password
                </label>
                <input
                  type="password"
                  id="loginPassword"
                  class="form-control"
                  name="password"
                  v-model="password"
                  v-bind:class="{ 'is-invalid': missingPassword }"
                  placeholder="Password"
                  required
                />

                <!-- Password Error -->

                <div class="text-danger" v-cloak v-show="isFormInvalid && missingPassword">
                  <span v-if="missingPassword">Password is Missing</span>
                </div>
              </div>
            </div>

            <!-- Loading -->
            <div v-if="loading" class="text-center m-2">
              <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>

            <!-- LINKS -->
            <div class="text-center">
              <a
                href="#"
                data-toggle="modal"
                data-dismiss="modal"
                data-target="#recoverPasswordModal"
              >Forgot Password?</a>
              <br />
              <a
                href="#"
                data-toggle="modal"
                data-dismiss="modal"
                data-target="#registerModal"
              >Create new Account</a>
            </div>

            <div class="text-right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function() {
    return {
      email: "",
      password: "",
      loading: false,
      attemptSubmit: false,
      serverError: false,
      serverErrorMessage: ""
    };
  },
  computed: {
    missingEmail: function() {
      return (
        this.email.trim() === "" && !this.hasServerError && this.attemptSubmit
      );
    },
    invalidEmail: function() {
      return (
        !this.missingEmail &&
        !this.validateEmail(this.email.trim()) &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    missingPassword: function() {
      return (
        this.password.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    hasClientError: function() {
      return this.missingEmail || this.invalidEmail || this.missingPassword;
    },
    hasServerError: function() {
      return this.serverError;
    },
    isFormInvalid: function() {
      return (this.hasClientError || this.hasServerError) && this.attemptSubmit;
    }
  },
  methods: {
    validateEmail: function(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    submitForm: function(event) {
      this.serverError = false;
      this.attemptSubmit = true;
      this.loading = true;
      if (!this.isFormInvalid) {
        const data = {
          email: this.email,
          password: this.password
        };
        axios
          .post("/api/login", data)
          .then(response => {
            localStorage.setItem(
              "access_token",
              "Bearer " + response.data.access_token
            );

            axios
              .get("/api/user", {
                headers: {
                  Authorization: "Bearer " + response.data.access_token
                }
              })
              .then(response => {
                // if (response.data.type == 1) {
                //   window.location.href = "/admin/#/home";
                //   this.loading = false;
                // } else if (response.data.type == 0) {
                window.location.href = "/";
                this.loading = false;
                // }
              })
              .catch(error => {
                this.serverError = true;
                this.serverErrorMessage = error.response.data.data;
                this.loading = false;
              });
          })
          .catch(error => {
            console.log("Error: " + error);
            this.serverError = true;
            this.serverErrorMessage = error.response.data.data;
            this.loading = false;
          });
      }
    }
  }
};
</script>