<template>
  <q-layout view="lHh Lpr lFf">
    <!-- <q-header class="bg-white text-black">
      <q-toolbar
        style="display: flex; justify-content: space-between; padding-top: 10px"
      >
        <q-btn flat @click="$router.replace('/')" icon="arrow_back"></q-btn>

        <q-toolbar-title style="width: 10px; padding: 0%">
          {{ label }}
        </q-toolbar-title>
        <div style="display: flex; align-items: center">
          <div style="display: flex; align-items: center; padding-bottom: 5px">
            <img
              src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
              alt="Deskripsi Foto"
              class="foto-styling"
              style="
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin: auto;
              "
            />
            <q-btn flat icon="logout"></q-btn>
          </div>
        </div>
      </q-toolbar>
    </q-header> -->

    <q-page-container>
      <router-view />
    </q-page-container>

    <q-footer class="bg-white text-black">
      <q-separator color="grey-5"></q-separator>
      <div
        style="display: flex; padding: 7px 0px; justify-content: space-around"
      >
        <q-item
          clickable
          v-ripple
          :active="menu === 'riwayat'"
          @click="menu = 'riwayat'"
          active-class="my-menu-link"
          to="/riwayat-penjual"
        >
          <q-item-section>
            <q-icon name="history" size="25px" class="icon-center"></q-icon>
            <div style="text-align: center; margin-top: 5px">Riwayat</div>
          </q-item-section>
        </q-item>
        <q-item
          clickable
          v-ripple
          :active="menu === 'rekap'"
          @click="menu = 'rekap'"
          active-class="my-menu-link"
          to="/rekap-penjual"
        >
          <q-item-section>
            <q-icon name="pie_chart" size="25px" class="icon-center"></q-icon>
            <div style="text-align: center; margin-top: 5px">Rekap</div>
          </q-item-section>
        </q-item>
        <q-item
          clickable
          v-ripple
          :active="menu === 'home'"
          @click="menu = 'home'"
          active-class="my-menu-link"
          to="/beranda-penjual"
        >
          <q-item-section>
            <q-icon name="home" size="25px" class="icon-center"></q-icon>
            <div style="text-align: center; margin-top: 5px">Beranda</div>
          </q-item-section>
        </q-item>
        <q-item
          clickable
          v-ripple
          :active="menu === 'pesanan'"
          @click="menu = 'pesanan'"
          active-class="my-menu-link"
          to="/pesanan-penjual"
        >
          <q-item-section>
            <q-icon name="local_mall" size="25px" class="icon-center"></q-icon>
            <div style="text-align: center; margin-top: 5px">Pesanan</div>
          </q-item-section>
        </q-item>
      </div>
    </q-footer>

    <!-- <q-footer class="bg-white text-black">
      <div
        style="display: flex; padding: 7px 0px; justify-content: space-around"
      >
      <q-tabs
        v-model="tab"
        inline-label
        :breakpoint="0"
        align="justify"
      >
        <q-tab
          name="mails"
          @click="$router.replace('beranda-penjual')"
        >
          <q-icon name="history" size="25px" class="icon-center"></q-icon>
          <div style="text-align: center; margin-top: 5px">Riwayat</div>
        </q-tab>
        <q-tab
          name="alarms"
          label="Alarms"
          @click="$router.replace('edit-pesanan')"
        />
        <q-tab name="movies" label="Movies" />
        <q-tab name="photos" label="Photos" />
      </q-tabs>
      </div>
    </q-footer> -->
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
import { useRouter } from "vue-router";

export default defineComponent({
  name: "MainLayout1",
  props: {
    title: {
      type: String,
      required: true,
    },
  },

  components: {},

  setup() {
    const leftDrawerOpen = ref(false);
    const router = useRouter();

    return {
      // essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },

      menu: ref("beranda"),
      // activeMenu: "",
      tab: ref("mails"),
    };
  },

  methods: {
    // handleClickMenu(menu) {
    //   this.activeMenu = menu;
    //   this.$router.push('/pesanan-penjual');
    // },
  },
});
</script>

<style>
.icon-center {
  display: block;
  margin: auto;
}
.my-menu-link {
  color: #f2c037;
}
</style>
