<template>
  <nav class="side-navbar">
    <div class="sidebar-header d-flex align-items-center">
      <div v-if="user.avatar" class="avatar">
        <img
          :src="`/img/avatars/${user.avatar}`"
          alt="Imagem de Perfil"
          class="img-fluid rounded-circle"
        />
      </div>
      <div class="title">
        <h1 class="h4">{{ user.first_name }} {{ user.last_name }}</h1>
        <p>{{ user.email }}</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus-->
    <span class="heading">Menu</span>
    <ul class="list-unstyled">
      <li>
        <router-link to="/home" title="Home">
          <i class="fal fa-home-lg"></i>Home
        </router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  data: function() {
    return {
      user: []
    };
  },
  methods: {
    getUser: function() {
      axios.get("/api/user").then(response => {
        this.user = response.data;
      });
    }
  },
  created: function() {
    this.getUser();
  }
};
</script>
