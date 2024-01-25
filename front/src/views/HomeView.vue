<script>
import { useApi, instance } from "../services";
import UrlTable from "../components/UrlTable.vue";

export default {
  data() {
    return {
      url: "",
      urls: [],
      erro: []
    }
  },
  components: {
    UrlTable
  },
  mounted() {
    this.getUrls()
  },
  methods: {
    logout() {
      useApi().post('logout')
        .then(() => {
          this.$router.push({
            path: '/'
          })
        })
        .catch((error) => console.log(error))
    },
    shortenerUrl() {
      useApi().post('url',
        {
          original_url: this.url
        })
        .then(() => {
          this.erro = [];
          this.url = [];
          this.getUrls()
        })
        .catch((error) => {
          this.erro = [];
          this.erro = error.response.data.message;
          console.log(error.response.data.message)
        })
    },
    getUrls() {
      useApi().get('url')
        .then((response) => {
          this.urls = response.data;
        })
    }
  }
}
</script>

<template>
  <div class="container mx-auto pt-48 flex flex-col justify-start items-center w-full max-w-xl">
    <div class="border-2 w-[500px] rounded">
      <div class="my-4 flex  justify-center items-center relative">
        <div class="cursor-pointer absolute left-[23px] flex justify-center items-center">
          <p class="text-xs ms-1 text-[#2563eb] cursor-pointer" @click="logout()">Logout</p>
        </div>
        <h1 class="text-2xl text-center">Encurtador de links</h1>
      </div>
      <hr class="mb-5">
      <div className='mx-3 mb-6 flex flex-wrap'>
        <div class='w-full px-3'>
          <label class='mb-1 block uppercase tracking-wide text-gray-700 text-lg'>
            URL
          </label>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none'
            type='text' placeholder="https://www.youtube.com/watch?v=vbyDU5YnNXQ" required v-model="url" />
          <span class="text-xs ms-1 text-rose-500" v-if="erro.length">Esta URL não é válida.</span>
        </div>
      </div>
      <div class="my-6 mx-10 flex justify-center items-center border-2 py-2 rounded cursor-pointer">
        <button @click.prevent="shortenerUrl()">Criar</button>
      </div>
    </div>
  </div>
  <UrlTable :urls="urls" />
</template>

<style scoped></style>
