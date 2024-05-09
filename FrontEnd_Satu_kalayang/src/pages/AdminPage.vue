<template>
  <q-page class="flex flex-center">

<!-- get data  -->
<div id="admin">
  {{ info }}
</div>


  </q-page>
</template>

<script setup>

defineOptions({
  name: 'AdminPage'
});


</script>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      info: null
    };
  },
  mounted() {
    this.viewPenjual();
  },
  methods: {
    viewPenjual() {
      axios.post('http://127.0.0.1:8000/api/viewmenu')
        .then(response => {
          // Handle the response
          this.info = response.data; // Update data with response
        })
        .catch(error => {
          // Handle the error
          console.error(error);
        });
    }
  }
}
</script>



