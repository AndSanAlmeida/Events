<template>
  <div
    class="modal fade"
    id="changePasswordModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="changePasswordModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="changePasswordModalLabel">Change Password</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" v-on:submit.prevent="validateForm">
            <!-- Alerts -->
            <div class="alert alert-success" role="alert" v-cloak v-show="success">
              <span>
                <strong class="pr-1">Success:</strong>Your Password was changed!
              </span>
            </div>

            <div class="alert alert-danger" role="alert" v-cloak v-show="isFormInvalid">
              <span v-if="hasClientError">
                <strong class="pr-1">Error:</strong>
                Review the Fields and Try Again
              </span>
              <span v-if="hasServerError">
                <strong class="pr-1">Error:</strong>
                {{serverErrorMessage}}
              </span>
            </div>

            <!-- Old Password -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="currentPassword">Current Password</label>
                <input
                  type="password"
                  id="currentPassword"
                  class="form-control"
                  placeholder="Current Password"
                  name="currentPassword"
                  v-model="currentPassword"
                  v-bind:class="{ 'is-invalid': missingCurrentPassword || wrongCurrentPassword }"
                />

                <!-- Password Errors -->
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="missingCurrentPassword">Actual Password is Missing</span>
                  <span v-if="wrongCurrentPassword">Your Current Password is Invalid</span>
                </div>
              </div>
            </div>

            <!-- Password -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="newPassword">New Password</label>
                <input
                  type="password"
                  id="newPassword"
                  class="form-control"
                  placeholder="New Password"
                  name="newPassword"
                  v-model="newPassword"
                  v-bind:class="{ 'is-invalid': missingNewPassword || invalidNewPassword  }"
                />

                <!-- Password Errors -->
                <div class="text-danger" v-cloak v-show="isFormInvalid">
                  <span v-if="missingNewPassword">New Password is Missing</span>
                  <span v-if="invalidNewPassword">New Password must have at least 6 chars</span>
                </div>
              </div>
            </div>

            <!-- Confirm Password -->
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="confirmPassword">New Password Confirmation</label>
                <input
                  type="password"
                  id="confirmPassword"
                  class="form-control"
                  placeholder="New Password Confirmation"
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

            <div class="text-right">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                v-on:click="cancel"
              >Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
  data: function() {
    return {
      currentPassword: "",
      newPassword: "",
      passwordConfirmation: "",
      attemptSubmit: false,
      serverErrorCode: 0,
      serverErrorMessage: "",
      success: false,
      loading: false
    };
  },
  computed: {
    missingCurrentPassword: function() {
      return (
        this.currentPassword.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    missingNewPassword: function() {
      return (
        this.newPassword.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    invalidNewPassword: function() {
      return (
        !this.missingNewPassword &&
        !this.validatePasswordStructure(this.newPassword.trim()) &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    missingPasswordConfirmation: function() {
      return (
        !this.missingNewPassword &&
        !this.invalidNewPassword &&
        this.passwordConfirmation.trim() === "" &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    wrongPasswordConfirmation: function() {
      return (
        !this.missingNewPassword &&
        !this.invalidNewPassword &&
        !this.missingPasswordConfirmation &&
        this.passwordConfirmation.trim() != this.newPassword.trim() &&
        !this.hasServerError &&
        this.attemptSubmit
      );
    },
    wrongCurrentPassword: function() {
      return this.serverErrorCode == 1;
    },
    hasClientError: function() {
      return (
        this.missingCurrentPassword ||
        this.missingNewPassword ||
        this.invalidNewPassword ||
        this.wrongPasswordConfirmation ||
        this.missingPasswordConfirmation
      );
    },
    hasServerError: function() {
      return this.serverErrorCode == -1 || this.wrongCurrentPassword;
    },
    isFormInvalid: function() {
      return (this.hasClientError || this.hasServerError) && this.attemptSubmit;
    }
  },
  methods: {
    validatePasswordStructure: function(password) {
      var re = /^[a-zA-Z0-9]{6,}$/;
      return re.test(password);
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
      if (!this.isFormInvalid) {
        this.loading = true;
        const data = {
          currentPassword: this.currentPassword,
          newPassword: this.newPassword
        };
        axios
          .post("api/user/password/update", data)
          .then(response => {
            this.success = true;
            this.loading = false;
            this.cancel();
          })
          .catch(error => {
            this.serverErrorCode = error.response.data.errorCode;
            this.serverErrorMessage = error.response.data.msg;
            this.loading = false;
          });
      }
    },
    cancel: function() {
      this.attemptSubmit = false;
      this.serverErrorCode = 0;
      this.currentPassword = "";
      this.newPassword = "";
      this.passwordConfirmation = "";
    }
  }
};
</script>