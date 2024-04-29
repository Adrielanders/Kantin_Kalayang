<template>
  <div id="app" class="bg-gradient">
    <div class="black-line"></div>
    <div class="center-box">
        <div class="inner-circle"></div>
      <div class="box">  
      <h6 id="fontjudul">Kantin Kalayang PUPR</h6>
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
  height: 100vh; /* Menentukan tinggi halaman sesuai dengan tinggi viewport */
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
  height: 100%;
  position: absolute;
}

.black-line {
  position: absolute;
  width: 100%;
  height: 2px;
  background-color: #000;
  margin-top: 50vh;
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
  margin-left: 720px;
}

.top-half {
  height: 50%;
}

.bg-gray {
  background-color: #d9d9d9; /* Warna abu-abu */
}

.bottom-half {
  height: 50%;
}

.bg-cream {
  background-color: #ffffff; /* Warna krem */
}

.inner-circle {
    position: absolute;
    width: 130px;
    height: 130px;
    background-color: #9A9A9A;
    border: 2px solid #000;
    border-radius: 50%;
    left: calc(50% - 50px);
    z-index: 3;
    margin-top: -29vh;
    margin-left: 41vh;
}
#fontjudul{
font-family: 'Inter', Arial, sans-serif;
}
</style>
