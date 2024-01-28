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
  <div class="container mx-auto pt-20 flex flex-col justify-start items-center">
    <div class="w-[500px]">
      <div class="cursor-pointer flex justify-start items-center">
        <p class="text-xs ms-1 text-[#ffca0be5] cursor-pointer" @click="logout()">Logout</p>
      </div>
      <h1 class="text-center my-4 text-white font-bold text-4xl mb-8">Encurtador de links</h1>
      <div className='flex flex-wrap'>
        <div class='w-full'>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none placeholder-black text-xl p-6'
            type='url' required v-model="url" placeholder="URL" />
          <span class="text-base mt-3 text-red-400" v-if="erro.length">Esta URL não é válida.</span>
        </div>
      </div>
      <button class="w-full bg-[#FFC90B] mt-4 hover:bg-[#ffca0be5] p-6 rounded text-xl tx-[#333B65] font-bold"
        @click.prevent=shortenerUrl()>
        Gerar
      </button>
    </div>
    <UrlTable :urls="urls" />
  </div>
</template>

<style scoped></style>
