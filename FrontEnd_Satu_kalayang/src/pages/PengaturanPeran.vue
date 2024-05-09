import { route } from 'quasar/wrappers';
<template>
  <q-page
    style="
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    "
  >
    <div style="display: flex; flex-direction: column; align-items: center">
      <q-card flat bordered style="border-color: black; margin: 5vh">
        <img
          src="/src/assets/WhatsApp Image 2024-04-30 at 13.17.28_a0a48e8c.jpg"
          alt="Deskripsi Foto"
          class="foto-styling"
          style="
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: auto;
            margin-top: 20px;
            margin-bottom: 25px;
          "
        />

        <div
          style="
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 20px;
          "
        >
          <h6 style="font-weight: 800; margin: 0%">Kantin Kalayang PUPR</h6>

          <div>
            <div style="display: flex; align-items: center; margin-top: 10px">
              <q-btn
                unelevated
                size="13px"
                no-caps
                class="text-weight-medium"
                icon="place"
                href="https://www.google.com/maps/place/Kantin+Layang+(Kalayang)+Kementerian+PUPR/@-6.2368072,106.7972376,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69f134dc4d07c3:0x5b9ce53f72b3e9e6!8m2!3d-6.2368125!4d106.7998125!16s%2Fg%2F11pd_k3ns2?entry=ttu"
                style="padding-left: 0%"
              />
              <a
                style="color: black; text-decoration: none"
                href="https://www.google.com/maps/place/Kantin+Layang+(Kalayang)+Kementerian+PUPR/@-6.2368072,106.7972376,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69f134dc4d07c3:0x5b9ce53f72b3e9e6!8m2!3d-6.2368125!4d106.7998125!16s%2Fg%2F11pd_k3ns2?entry=ttu"
                >Kantin Layang (Kalayang) Kementerian PUPR</a
              >
            </div>

            <div
              style="display: flex; flex-direction: row; align-items: center"
            >
              <q-btn
                unelevated
                size="13px"
                no-caps
                class="text-weight-medium"
                icon="access_time"
                style="padding-left: 0%"
              />
              <div style="margin-top: 10px">
                <p style="margin: 0%">Senin - Jumat 07.00–19.00</p>
                <p style="margin: 0%">Sabtu & Minggu TUTUP</p>
                <!-- <q-btn @click="$router.replace('/')">back</q-btn> -->
              </div>
            </div>
          </div>
        </div>
      </q-card>

      <div style="margin-top: 20px">
        <h6 style="font-weight: 550; margin-bottom: 10px; margin-top: 0px">
          Lanjutkan sebagai:
        </h6>
        <q-btn
          outline
          style="
            color: black;
            margin-right: 10px;
            padding: 50px;
            font-size: 16px;
          "
          label="Penjual"
          @click="$router.replace('/beranda-penjual')"
        />
        <q-btn
          outline
          style="color: black; padding: 50px; font-size: 16px"
          label="Pembeli"
          @click="$router.replace('/beranda-pembeli')"
        />
      </div>
    </div>
  </q-page>
</template>

<style>
.q-btn {
  text-transform: none;
}
</style>
