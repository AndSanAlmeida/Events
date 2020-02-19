<template>
  <div
    class="modal fade"
    id="loginModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="loginModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="loginModalLabel">Sign In</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="email">
                  <i class="fad fa-mailbox fa-lg mr-2"></i>Email
                </label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="name@email.com"
                  required
                />
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="password">
                  <i class="fad fa-key fa-lg mr-2"></i>Password
                </label>
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  placeholder="Password"
                  required
                />
              </div>
            </div>

            <!-- LINKS -->
            <div class="text-center">
              <a
                href="#"
                data-toggle="modal"
                data-dismiss="modal"
                data-target="#forgotPasswordModal"
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
    missingPassword: function() {
      return (
        this.password.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    hasClientError: function() {
      return this.missingEmail || this.missingPassword;
    },
    hasServerError: function() {
      return this.serverError;
    },
    isFormInvalid: function() {
      return (this.hasClientError || this.hasServerError) && this.attemptSubmit;
    }
  },
  methods: {
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
                if (response.data.type == 1) {
                  window.location.href = "/admin/#/home";
                  this.loading = false;
                } else if (response.data.type == 0) {
                  window.location.href = "/";
                  this.loading = false;
                }
              })
              .catch(error => {
                this.serverError = true;
                this.serverErrorMessage = error.response.data.data;
                this.loading = false;
              });
          })
          .catch(error => {
            this.serverError = true;
            console.log(error);
            this.serverErrorMessage = error.response.data.data;
            this.loading = false;
          });
      }
    }
  }
};
</script>