<template>
  <div id="app" class="bg-gradient">
    <div class="black-line"></div>
    <div class="center-box">
      <div class="inner-circle"></div>
      <div class="box">
        <h6 id="fontjudul">Kantin Kalayang PUPR</h6>
        <img src="/MapPin.png" >
      </div>
    </div>

    <div class="top-half bg-gray"></div>
    <div class="bottom-half bg-cream"></div>
  </div>
</template>

<script setup>
import { defineOptions } from "vue";
defineOptions({
  name: "IndexPage",
});
</script>

<style>
#app {
  font-family: Arial, sans-serif;
  text-align: center;
  min-height: 100vh; /* Menggunakan min-height agar konten tetap terlihat saat viewport kecil */
  display: flex;
  flex-direction: column;
}

.bg-gradient {
  background: linear-gradient(to bottom, #d9d9d9 50%, #ffffff 50%);
}

.center-box {
  display: flex;
  justify-content: center;
  align-items: center;
  height: calc(100vh - 2px); /* Mengurangi tinggi garis hitam dari tinggi viewport */
  position: relative; /* Ganti menjadi relative agar posisi kotak terkait dengan center-box */
}

.black-line {
  position: absolute;
  width: 100%;
  height: 2px;
  background-color: #000;
  margin-top: calc(50vh - 1px); /* Menyesuaikan posisi tengah vertikal */
  z-index: 1;
}

.box {
  width: 294px; /* Lebar kotak */
  height: 229px; /* Tinggi kotak */
  background-color: #fff;
  border: 1px solid #333;
  border-radius: 5px;
  padding: 20px;
  z-index: 2; /* Mengatur kotak agar muncul di atas garis hitam */
}

.top-half,
.bottom-half {
  flex-grow: 1; /* Memastikan bagian atas dan bawah mengisi sisa ruang */
}

.bg-gray {
  background-color: #d9d9d9; /* Warna abu-abu */
}

.bg-cream {
  background-color: #ffffff; /* Warna krem */
}

.inner-circle {
  position: absolute;
  width: 130px;
  height: 130px;
  background-color: #9a9a9a;
  border: 2px solid #000;
  border-radius: 50%;
  left: 50%;
  transform: translateX(-50%);
  z-index: 3;
  margin-top: calc(-20vh - 65px); /* Menyesuaikan posisi tengah vertikal */
}

#fontjudul {
  font-family: 'Inter', Arial, sans-serif;
}

/* Media queries untuk tampilan responsif */
@media screen and (max-width: 700px) {
  .box {
    width: 80%; /* Mengubah lebar kotak menjadi responsif */
    margin-top: 20px; /* Atur margin atas untuk jarak dari lingkaran */
  }

  .inner-circle {
    width: 100px; /* Mengubah lebar lingkaran dalam kotak */
    height: 100px; 
    margin-top: calc(50vh - 595px);
  }
}
</style>
