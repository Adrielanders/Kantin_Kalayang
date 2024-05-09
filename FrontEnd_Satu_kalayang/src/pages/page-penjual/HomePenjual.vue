import { route } from 'quasar/wrappers';
<template>
  <div style="display: flex; justify-content: center">
    <q-page style="display: flex; flex-direction: column">
      <div style="display: flex; flex-direction: column; align-items: center">
        <HeaderCreate title="Nama Toko" backAction="/" />
        <q-input
          outlined
          class="search-bar"
          v-model="text"
          placeholder="Cari makanan / toko"
          color="black"
          style="padding-top: 5px; width: 93%"
        >
          <!-- <q-icon name="event" color="orange" /> -->
          <q-btn
            unelevated
            size="13px"
            no-caps
            class="text-weight-medium"
            icon="search"
            style="padding: 0%"
          />
        </q-input>
      </div>

      <div class="categories" style="display: flex; margin-top: 15px">
        <div style="text-align: center; margin: auto">
          <img
            src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
            alt="Deskripsi Foto"
            class="category"
          />
          <p class="text-category">Makanan Berat</p>
        </div>
        <div style="text-align: center; margin: auto">
          <img
            src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
            alt="Deskripsi Foto"
            class="category"
          />
          <p class="text-category">Makanan Ringan</p>
        </div>
        <div style="text-align: center; margin: auto">
          <img
            src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
            alt="Deskripsi Foto"
            class="category"
          />
          <p class="text-category">Minuman</p>
        </div>
      </div>

      <div style="display: flex; flex-direction: column; margin-left: 3%">
        <h6 style="font-weight: 800; margin: 0%">Menu</h6>
      </div>

      <div style="display: flex">
        <div style="text-align: center">
          <img
            src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
            alt="Deskripsi Foto"
            class="category"
          />
          <div style="display: flex; margin-left: 10%">
            <div style="text-align: left">
              <p style="margin: 0; font-weight: 700; font-size: 15px">Menu 1</p>
              <p style="margin: 0">18.000</p>
            </div>
            <q-btn
              unelevated
              size="11px"
              no-caps
              rounded
              class="text-weight-medium"
              icon="edit"
              @click="$router.replace('/edit-pesanan')"
              style="margin-left: auto; margin-bottom: auto; margin-right: 5%"
            />
          </div>
        </div>
        <div style="text-align: center">
          <img
            src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
            alt="Deskripsi Foto"
            class="category"
          />
          <div style="display: flex; margin-left: 10%">
            <div style="text-align: left">
              <p style="margin: 0; font-weight: 700; font-size: 15px">Menu 1</p>
              <p style="margin: 0">18.000</p>
            </div>
            <q-btn
              unelevated
              size="11px"
              no-caps
              class="text-weight-medium"
              icon="edit"
              style="margin-left: auto; margin-bottom: auto; margin-right: 5%"
            />
          </div>
        </div>
        <div style="text-align: center">
          <img
            src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
            alt="Deskripsi Foto"
            class="category"
          />
          <div style="display: flex; margin-left: 10%">
            <div style="text-align: left">
              <p style="margin: 0; font-weight: 700; font-size: 15px">Menu 1</p>
              <p style="margin: 0">18.000</p>
            </div>
            <q-btn
              unelevated
              size="11px"
              no-caps
              class="text-weight-medium"
              icon="edit"
              style="margin-left: auto; margin-bottom: auto; margin-right: 5%"
            />
          </div>
        </div>
      </div>
    </q-page>
  </div>
</template>

<script>
import HeaderCreate from "components/HeaderCreate.vue";
import { ref } from "vue";

export default {
  components: {
    HeaderCreate,
  },
  setup() {
    const text = ref("");

    const slide1 = ref(1);
    const slide2 = ref("one");

    const autoplay1 = ref(true);
    const autoplay2 = ref(true);

    return {
      text,
      slide1,
      slide2,
      autoplay1,
      autoplay2,
    };
  },
};
</script>

<style>
@media screen and (max-width: 40vh) {
  .categories {
    display: flex;
    flex-direction: column;
  }
}

.category {
  max-width: 80%;
  height: auto;
  margin: auto;
  margin-top: 5px;
  margin-bottom: 5px;
}

.text-category {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.carousel-slide {
  position: relative;
  width: 100%;
  height: auto;
  padding: 0%;
}

.text-container {
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  text-align: center;
}

.pesan-img {
  object-fit: cover;
  width: 100%;
  height: 150px;
}
</style>
