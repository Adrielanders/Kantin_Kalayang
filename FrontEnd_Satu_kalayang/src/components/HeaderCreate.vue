<template>
  <q-header class="bg-white text-black">
    <q-toolbar
      style="display: flex; justify-content: space-between; padding-top: 10px"
    >
      <q-btn
        flat
        @click="$router.replace(backAction)"
        icon="arrow_back"
      ></q-btn>

      <q-toolbar-title style="width: 10px; padding: 0%; font-weight: bold;">
        {{ title }}
      </q-toolbar-title>
      <div style="display: flex; align-items: center">
        <div style="display: flex; align-items: center; padding-bottom: 5px">
          <img
            v-if="!hideProfile"
            clickable
            @click="$router.replace('/profile')"
            src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
            alt="Deskripsi Foto"
            class="foto-styling"
            style="width: 40px; height: 40px; border-radius: 50%; margin: auto"
          />
          <q-btn
            v-if="!hideLogout"
            flat
            icon="logout"
            @click="openDialogLogout()"
          ></q-btn>
        </div>
      </div>
    </q-toolbar>
  </q-header>

  <q-dialog v-model="dialogLogout">
    <q-card
      class="my-card"
      style="width: 569px; border-radius: 30px; padding: 10px"
    >
      <q-card-section class="row items-center q-pb-none">
        <div class="text-h6"></div>
        <q-space />
        <q-btn icon="close" flat round dense v-close-popup />
      </q-card-section>

      <q-card-section class="q-pt-none">
        <div class="row full-width justify-center items-center text-center">
          <div class="col">
            <p class="text-subtitle1 text-bold q-mb-xs">Yakin ingin logout?</p>
            <!-- <p class="text-caption q-mt-xs" style="color: #68737c">
                Dokumen akan dihapus secara permanen.
              </p> -->
          </div>
        </div>
      </q-card-section>
      <q-card-actions align="center">
        <q-btn
          class="delete-btn"
          flat
          filled
          label="Batal"
          @click="hapusData()"
          style="text-transform: none; padding-left: 17px; padding-right: 17px"
          v-close-popup
        />
        <q-btn
          rounded
          unelevated
          label="Ya"
          style="text-transform: none"
          color="red"
          v-close-popup
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "HeaderCreate",
  props: {
    title: {
      type: String,
      required: true,
    },
    backAction: {
      type: String,
    },
    hideProfile: {
      type: Boolean,
    },
    hideLogout: {
      type: Boolean,
    },
  },

  setup() {
    const dialogLogout = ref(false);

    return {
      dialogLogout,
    };
  },

  methods: {
    openDialogLogout() {
      this.dialogLogout = true;
    },
  },
});
</script>

<style scoped>
/* Sesuaikan dengan gaya header Anda */
</style>
