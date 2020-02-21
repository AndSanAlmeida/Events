<template>
  <form method="post" v-on:submit="validateForm">
    <!-- Alerts -->
    <div class="alert alert-success alert-dismissible" role="alert" v-cloak v-show="success">
      <span>
        <strong class="pr-1">Success:</strong>Your Account was updated!
      </span>
    </div>

    <!-- First Name -->
    <div class="row form-group">
      <div class="col-md-12">
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
    </div>

    <!-- Last Name -->
    <div class="row form-group">
      <div class="col-md-12">
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
        </div>
        <div class="text-danger" v-cloak v-show="isFormInvalid">
          <span v-if="invalidEmail">Invalid Email</span>
        </div>
      </div>
    </div>

    <div class="text-right">
      <button type="button" @click="getData" class="btn btn-secondary">Cancel</button>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</template>

<script>
export default {
  data: function() {
    return {
      firstName: "",
      lastName: "",
      email: "",
      attemptSubmit: false,
      serverErrorCode: 0,
      serverErrorMessage: "",
      success: false
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
      return this.serverErrorCode == -1 || this.emailAlreadyUsed;
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
    validateForm: function() {
      //CLEARS SERVER ERROR'S
      this.serverErrorCode = 0;
      this.success = false;

      //PREVENT FORM
      event.preventDefault();

      //FORM SUBMITED
      this.attemptSubmit = true;

      //IF FORM IS VALID MAKE API REQUEST FOR LOGIN
      if (!this.isFormInvalid) {
        const data = {
          firstName: this.firstName,
          lastName: this.lastName,
          email: this.email
        };
        axios
          .post("/api/user/update", data)
          .then(response => {
            this.success = true;
          })
          .catch(error => {
            this.serverErrorCode = error.response.data.errorCode;
            this.serverErrorMessage = error.response.data.msg;
          });
      }
    },
    getData: function() {
      this.success = false;
      this.serverError = 0;
      this.attemptSubmit = false;
      axios.get("/api/user").then(response => {
        this.avatar = "img/avatars/" + response.data.avatar;
        this.firstName = response.data.first_name;
        this.lastName = response.data.last_name;
        this.email = response.data.email;
      });
    }
  },
  created: function() {
    this.getData();
  }
};
</script>