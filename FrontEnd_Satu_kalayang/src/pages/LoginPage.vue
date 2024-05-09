<template>
  <q-page class="">
    <q-form @submit="register" action="/tes">

      <q-input v-model="formData.email" label="Email" />
      <q-input v-model="formData.password" type="password" label="Password" />
      <q-btn type="submit" label="Login" color="primary" />
    </q-form>

  </q-page>
</template>

<script setup>
defineOptions({
  name: 'LoginPage'
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
      password:''
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

