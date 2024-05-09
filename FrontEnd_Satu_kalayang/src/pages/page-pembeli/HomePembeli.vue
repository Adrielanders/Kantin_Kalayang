import { route } from 'quasar/wrappers';
<template>
  <!-- <q-btn flat @click="$router.replace('/')" icon="arrow_back" style="margin-top: 5px;"></q-btn> -->
  <HeaderCreate title="SATU KALAYANG" backAction="/" :hideLogout="true" :hideProfile="true"/>

  <div style="display: flex; justify-content: center; height: 100vh">
    <q-page style="display: flex; flex-direction: column; height: 100vh">
      <div style="display: flex; flex-direction: column; align-items: center">
        <!-- <h6 style="font-weight: 800; margin: 0%">SATU KALAYANG</h6> -->

        <q-input
          outlined
          class="search-bar"
          v-model="text"
          placeholder="Cari makanan / toko"
          color="black"
          style="padding-top: 10px; width: 93%"
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
      <div class="categories" style="display: flex">
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

      <!-- display: flex; -->
      <div
        style="flex-direction: column; margin-left: 12px; margin-right: 12px"
      >
        <div>
          <h6 style="font-weight: 800; margin-top: 5px; margin-bottom: 5px">
            Diskon Hari Ini
          </h6>
          <!-- autoplay
            @mouseenter="autoplay1 = false"
            @mouseleave="autoplay1 = true" -->
          <q-carousel
            arrows
            animated
            infinite
            v-model="slide1"
            class="carousel"
            style="width: 40%;"
          >
            <q-carousel-slide name="first" class="carousel-slide">
              <q-img
                class="pesan-img"
                src="https://cdn.quasar.dev/img/mountains.jpg"
              />
              <div class="text-container">
                <div class="text-h6">Kios 1</div>
                <div class="text-subtitle1">
                  Deskripsi kios
                </div>
              </div>
            </q-carousel-slide>
            <q-carousel-slide name="second" class="carousel-slide">
              <q-img
                class="pesan-img"
                src="https://cdn.quasar.dev/img/parallax1.jpg"
              />
              <div class="text-container">
                <div class="text-h6">Kios 2</div>
                <div class="text-subtitle1">
                  Deskripsi kios ini jual apa aja lalalalala
                </div>
              </div>
            </q-carousel-slide>
          </q-carousel>
        </div>
        <div>
          <h6 style="font-weight: 800; margin-top: 20px; margin-bottom: 5px">
            Pesan Sekarang
          </h6>
          <!-- autoplay
            @mouseenter="autoplay2 = false"
            @mouseleave="autoplay2 = true" -->
          <q-carousel
            arrows
            animated
            infinite
            v-model="slide2"
            class="carousel"
          >
            <q-carousel-slide name="first" class="carousel-slide">
              <q-img
                class="pesan-img"
                src="https://cdn.quasar.dev/img/mountains.jpg"
              />
              <div class="text-container">
                <div class="text-h6">Kios 1</div>
                <div class="text-subtitle1">
                  Deskripsi kios ini jual apa aja lalalalala
                </div>
              </div>
            </q-carousel-slide>
            <q-carousel-slide name="second" class="carousel-slide">
              <q-img
                class="pesan-img"
                src="https://cdn.quasar.dev/img/parallax1.jpg"
              />
              <div class="text-container">
                <div class="text-h6">Kios 2</div>
                <div class="text-subtitle1">
                  Deskripsi kios ini jual apa aja lalalalala
                </div>
              </div>
            </q-carousel-slide>
          </q-carousel>
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

    const autoplay1 = ref(true);
    const autoplay2 = ref(true);

    return {
      text,

      slide1: ref("first"),
      slide2: ref("first"),
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
  margin-top: 20px;
  margin-bottom: 5px;
}

.text-category {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.carousel {
  height: 50%;
}

.carousel-slide {
  position: relative;
  width: 100%;
  height: 50%;
  padding: 0%;
  overflow: hidden;
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
  /* height: 40%; */
  height: 150px;
}
</style>
