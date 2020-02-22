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
            <!-- Alerts -->
            <div class="alert alert-success" role="alert" v-cloak v-show="success">
              <span class="text-center">
                <strong class="pr-1">Success:</strong>
                Email with the information to recover the password was sent. Check your email.
              </span>
            </div>
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
                  <span v-if="invalidEmail">Invalid Email</span>
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
              >Back to Sign In?</a>
            </div>

            <div class="text-right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Send Email</button>
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
            setTimeout(() => this.$router.push({ path: "/" }), 3000);
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
