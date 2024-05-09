<template>
  <q-page class="">
    <q-form @submit="register" action="/tes">

      <q-input v-model="formData.email" label="Email" />
      <q-input v-model="formData.nama_toko" label="Nama Toko" />
      <q-input v-model="formData.nama_pemilik_toko" label="Nama Pemiilik Toko" />
      <q-input v-model="formData.nomor_telepon" label="Nomor Telepon" />
      <q-input v-model="formData.nomor_toko" label="nomor toko" />
      <q-btn type="submit" label="Register" color="primary" />
    </q-form>

  </q-page>
</template>

<script setup>
defineOptions({
  name: 'RegisterPage'
});


</script>

<script>
import axios from 'axios';
// import { $api } from 'boot/axios';

export default {
  data () {
    return {
      formData: {
      email :'',
      nama_toko :'',
      nama_pemilik_toko:'',
      nomor_telepon:'',
      nomor_toko:'' 
      }
    }
  },
  methods: {
    register () {

      axios.post('http://127.0.0.1:8000/api/savedatanew', this.formData)
        .then(response => {
          // Handle the response
        })
        .catch(error => {
          // Handle the error
        })
    }
  }
}
</script>

