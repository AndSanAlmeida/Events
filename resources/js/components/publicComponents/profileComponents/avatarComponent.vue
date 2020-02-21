<template>
  <form>
    <!-- Alerts -->
    <div class="alert alert-success alert-dismissible" role="alert" v-cloak v-show="success">
      <span>
        <strong class="pr-1">Success:</strong>Image was changed with Success!
      </span>
    </div>
    <div class="alert alert-danger alert-dismissible" role="alert" v-cloak v-show="wrongFormat">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span>
        <strong>Error:</strong>Invalid Image Format - JPEG | JPG | PNG
      </span>
    </div>

    <div class="form-group">
      <div class="col-12">
        <!-- Current avatar -->
        <img
          class="img-responsive rounded-circle"
          v-if="avatar != ''"
          :src="avatar"
          alt="Profile Image"
          title="Profile Image"
          width="150px"
          height="150px"
        />
        <p class="help-block">
          Chose an Image for your Profile
          <br />Formats - JPEG | JPG | PNG
        </p>
      </div>
    </div>
    <div class="form-group">
      <div class="col-12">
        <label class="btn btn-success mb-0" for="inputImage" title="Send Avatar">
          <input
            type="file"
            v-on:change="onFileChange"
            class="sr-only"
            id="inputImage"
            name="file"
            accept="image/*"
          />
          <span>Chose an Image</span>
        </label>

        <button type="button" @click="upload" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  data: function() {
    return {
      avatar: "",
      success: false,
      avatarChanged: false,
      wrongFormat: false
    };
  },
  methods: {
    getAvatar: function() {
      axios.get("/api/user").then(response => {
        this.avatar = "img/avatars/" + response.data.avatar;
      });
    },
    onFileChange(e) {
      this.success = false;
      this.wrongFormat = false;
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      if (
        file.type == "image/jpeg" ||
        file.type == "image/jpg" ||
        file.type == "image/png"
      ) {
        this.avatar = "";
        let reader = new FileReader();
        let vm = this;
        reader.onload = e => {
          vm.avatar = e.target.result;
        };

        reader.readAsDataURL(file);
        this.avatarChanged = true;
      } else {
        this.wrongFormat = true;
      }
    },
    upload() {
      if (this.avatarChanged) {
        axios
          .post("/api/user/avatar/update", { avatar: this.avatar })
          .then(response => {
            this.success = true;
            this.avatarChanged = false;
            this.getAvatar();
          });
      }
    }
  },
  created: function() {
    this.getAvatar();
  }
};
</script>