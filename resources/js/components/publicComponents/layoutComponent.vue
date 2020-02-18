<template>
  <div>
    <public-header></public-header>
    <router-view></router-view>
    <public-footer></public-footer>
  </div>
</template>
<script>
import publicHeader from "../publicComponents/includesComponents/publicHeaderComponent.vue";
import publicFooter from "../publicComponents/includesComponents/publicFooterComponent.vue";
export default {
  components: {
    "public-header": publicHeader,
    "public-footer": publicFooter
  }
};
</script>
