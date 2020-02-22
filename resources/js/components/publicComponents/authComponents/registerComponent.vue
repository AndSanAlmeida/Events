<template>
  <div
    class="modal fade"
    id="registerModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="registerModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="registerModalLabel">Register</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" v-on:submit.prevent="validateForm">
            <!-- Alerts -->
            <div class="alert alert-success" role="alert" v-cloak v-show="success">
              <span>
                <strong class="pr-1">Success:</strong>User Created with Success
              </span>
            </div>

            <div
              class="alert alert-danger"
              role="alert"
              v-cloak
              v-show="serverErrorCode != 0 || serverError"
            >
              <span>
                <strong class="pr-1">Error:</strong>
                {{serverErrorMessage}}
              </span>
            </div>

            <div class="row form-group">
              <!-- First Name -->
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">First Name</label>
                <input
                  type="text"
                  id="fname"
                  class="form-control"
                  placeholder="First Name"
                  name="firstName"
                  v-model="firstName"
                  v-bind:class="{ 'is-invalid': missingFirstName  }"
                />

                <!-- First Name Error -->
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="missingFirstName">First Name is Missing</span>
                </div>
              </div>

              <!-- Last Name -->
              <div class="col-md-6">
                <label class="text-black" for="lname">Last Name</label>
                <input
                  type="text"
                  id="lname"
                  class="form-control"
                  placeholder="Last Name"
                  name="lastName"
                  v-model="lastName"
                  v-bind:class="{ 'is-invalid': missingLastName  }"
                />

                <!-- Last Name Error -->
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="missingLastName">Last Name is Missing</span>
                </div>
              </div>
            </div>

            <!-- Email -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="registerEmail">Email</label>
                <input
                  type="email"
                  id="registerEmail"
                  class="form-control"
                  placeholder="name@email.com"
                  name="email"
                  v-model="email"
                  v-bind:class="{ 'is-invalid': missingEmail || invalidEmail || emailAlreadyUsed  }"
                />

                <!-- Email Errors -->
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="missingEmail">Email is Missing</span>
                  <span v-if="invalidEmail">Invalid Email</span>
                </div>
              </div>
            </div>

            <!-- Password -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="registerPassword">Password</label>
                <input
                  type="password"
                  id="registerPassword"
                  class="form-control"
                  placeholder="Password"
                  name="password"
                  v-model="password"
                  v-bind:class="{ 'is-invalid': missingPassword || invalidPassword }"
                />

                <!-- Password Errors -->
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="missingPassword">Password is Missing</span>
                  <span v-if="invalidPassword">Password must have at least 6 chars</span>
                </div>
              </div>
            </div>

            <!-- Confirm Password -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="confirmPassword">Confirm Password</label>
                <input
                  type="password"
                  id="confirmPassword"
                  class="form-control"
                  placeholder="Password"
                  name="passwordConfirmation"
                  v-model="passwordConfirmation"
                  v-bind:class="{ 'is-invalid': missingPasswordConfirmation || wrongPasswordConfirmation }"
                />

                <!-- Password Confirmation Errors -->
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="missingPasswordConfirmation">Password Confirmation is Missing</span>
                  <span v-if="wrongPasswordConfirmation">Passwords doesn't match. Try again!</span>
                </div>
              </div>
            </div>

            <!-- Loading -->
            <div v-if="loading" class="text-center m-2">
              <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>

            <!-- <vue-recaptcha
                align="center"
                @verify="onCaptchaVerified"
                sitekey="6LdxSGAUAAAAAArJ_prh93hEVYhyLQ13Xt2Ik4_b">
            </vue-recaptcha>-->

            <!-- LINKS -->
            <p class="text-center">
              <a
                href="#"
                data-toggle="modal"
                data-dismiss="modal"
                data-target="#loginModal"
              >Already have an Account?</a>
            </p>

            <div class="text-right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
//import VueRecaptcha from 'vue-recaptcha';
export default {
  data: function() {
    return {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      loading: false,
      // isVerifiedWithRecaptcha: false,
      passwordConfirmation: "",
      attemptSubmit: false,
      serverErrorCode: 0,
      serverError: false,
      serverErrorMessage: ""
    };
  },
  computed: {
    missingFirstName: function() {
      return (
        this.firstName.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    missingLastName: function() {
      return (
        this.lastName.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
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
    emailAlreadyUsed: function() {
      return this.serverErrorCode == 1;
    },
    missingPassword: function() {
      return (
        this.password.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    invalidPassword: function() {
      return (
        !this.missingPassword &&
        !this.validatePasswordStructure(this.password.trim()) &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    missingPasswordConfirmation: function() {
      return (
        !this.missingPassword &&
        !this.invalidPassword &&
        this.passwordConfirmation.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    wrongPasswordConfirmation: function() {
      return (
        !this.missingPassword &&
        !this.invalidPassword &&
        !this.missingPasswordConfirmation &&
        this.passwordConfirmation.trim() != this.password.trim() &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    hasClientError: function() {
      return (
        this.missingFirstName ||
        this.missingLastName ||
        this.missingEmail ||
        this.missingPassword ||
        this.invalidPassword ||
        this.wrongPasswordConfirmation ||
        this.missingPasswordConfirmation ||
        this.invalidEmail
      );
    },
    hasServerError: function() {
      return (
        this.serverErrorCode == -1 || this.serverError || this.emailAlreadyUsed
      );
    },
    isFormInvalid: function() {
      return (this.hasClientError || this.hasServerError) && this.attemptSubmit;
    }
  },
  methods: {
    // onCaptchaVerified: function() {
    //   this.isVerifiedWithRecaptcha = true;
    // },
    validateEmail: function(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    validatePasswordStructure: function(password) {
      var re = /^[a-zA-Z0-9]{6,}$/;
      return re.test(password);
    },
    clear: function() {
      this.firstName = "";
      this.lastName = "";
      this.email = "";
      this.password = "";
      this.passwordConfirmation = "";
      this.attemptSubmit = false;
      this.serverErrorCode = 0;
      this.loading = false;
      this.serverError = false;
      this.serverErrorMessage = "";
    },
    validateForm: function() {
      //CLEARS SERVER ERROR'S
      this.serverErrorCode = 0;
      this.success = false;

      //PREVENT FORM
      event.preventDefault();

      //FORM SUBMITED
      this.attemptSubmit = true;

      //IF FORM IS VALID MAKE API REQUEST
      //if (!this.isFormInvalid && this.isVerifiedWithRecaptcha == true) {
      if (!this.isFormInvalid) {
        this.loading = true;
        const data = {
          firstName: this.firstName,
          lastName: this.lastName,
          email: this.email,
          password: this.password
        };
        axios
          .post("/api/register", data)
          .then(response => {
            this.success = true;
            this.clear();
            // Its true, cuz it will sigh in Auto
            this.loading = true;

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
                    window.location.href = "/";
                    this.loading = false;
                  })
                  .catch(error => {
                    this.serverError = -1;
                    this.serverErrorMessage = error.response.data.data;
                    this.loading = false;
                  });
              })
              .catch(error => {
                console.log("Error: " + error);
                this.serverError = false;
                this.serverErrorMessage = error.response.data.data;
                this.loading = false;
              });
          })
          .catch(error => {
            this.loading = false;
            this.serverErrorCode = error.response.data.errorCode;
            this.serverErrorMessage = error.response.data.msg;
          });
      }
    }
  }
  // components: {
  //     VueRecaptcha
  // },
};
</script>