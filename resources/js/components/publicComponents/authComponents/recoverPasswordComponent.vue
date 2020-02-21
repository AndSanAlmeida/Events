<template>
  <div
    class="modal fade"
    id="recoverPasswordModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="recoverPasswordModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="recoverPasswordModalLabel">Recover Password</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form method="post" v-on:submit.prevent="submitForm">
            <!-- Alert -->
            <div class="alert alert-danger" role="alert" v-cloak v-show="serverError">
              <span>{{serverErrorMessage}}</span>
            </div>
            <!-- Success -->
            <div class="alert alert-success" role="alert" v-cloak v-show="success">
              <p
                class="text-center"
              >Email com a informação para recuperar a password foi enviado. Verifique o seu email.</p>
            </div>

            <!-- Email -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="recoverEmail">
                  <i class="fad fa-mailbox fa-lg mr-2 text-primary"></i>Email
                </label>
                <input
                  type="email"
                  id="recoverEmail"
                  class="form-control"
                  name="email"
                  v-model="email"
                  v-bind:class="{ 'is-invalid': missingEmail  }"
                  placeholder="name@email.com"
                  required
                />

                <!-- Email Error -->
                <div class="clearfix">
                  <div
                    class="alert alert-danger"
                    role="alert"
                    v-cloak
                    v-show="isFormInvalid && missingEmail "
                  >
                    <span v-if="missingEmail">Email is Missing</span>
                  </div>
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
                data-target="#loginModal"
              >Back to Sign In</a>
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
              <button type="submit" class="btn btn-primary">Recover</button>
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
      attemptSubmit: false,
      serverError: false,
      serverErrorMessage: "",
      success: false,
      loading: false
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
    hasClientError: function() {
      return this.missingEmail || this.invalidEmail;
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
      //CLEARS SERVER ERROR'S
      this.serverError = false;
      this.success = false;

      //PREVENT FORM

      event.preventDefault();

      //FORM SUBMITED
      this.attemptSubmit = true;

      //IF FORM IS VALID MAKE API REQUEST FOR LOGIN
      if (!this.isFormInvalid) {
        this.loading = true;
        const data = {
          email: this.email
        };
        axios
          .post("/api/password/email", data)
          .then(response => {
            this.success = true;
            this.attemptSubmit = false;
            this.loading = false;
            setTimeout(() => this.$router.push({ path: "/login" }), 5000);
          })
          .catch(error => {
            this.loading = false;
            this.serverError = true;
            this.serverErrorMessage = error.response.data.msg;
          });
      }
    }
  }
};
</script>
