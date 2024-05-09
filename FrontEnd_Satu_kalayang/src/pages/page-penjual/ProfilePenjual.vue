import { route } from 'quasar/wrappers';

<template>
  <HeaderCreate title="Profile" backAction="/beranda-penjual" :hideLogout="true" :hideProfile="true"/>
  <h1>profile</h1>
  <p>yuhu</p>

</template>

<script>
import HeaderCreate from "components/HeaderCreate.vue";
import { ref } from "vue";

export default {
  components: {
    HeaderCreate,
  },
};
</script>
