<script>
import { instance } from "../services";

export default {
  data() {
    return {
      email: "",
      password: "",
      error: []
    }
  },
  methods: {
    login() {
      instance.post('login',
        {
          email: this.email,
          password: this.password
        }
      ).then((response) => {
        localStorage.token = response.data.api_token;
        this.$router.push({
          path: '/home'
        })
      }).catch((error) => {
        this.error = []
        this.error = error.response.data
      })
    }
  }
}
</script>

<template>
  <div class="container mx-auto flex flex-row justify-between items-center h-screen max-w-4xl">
    <div class="flex justify-start items-center w-3/6 text-7xl text-white font-bold italic" style="text-shadow: 2px 2px
      #ff0000">
      Encurtador de Links
    </div>
    <div class="flex flex-col justify-start items-center w-3/6">
      <div class="w-[500px]">
        <h1 class="text-center my-4 text-white font-bold text-4xl mb-8">Login</h1>
        <div className='flex flex-wrap'>
          <div class='w-full'>
            <input
              class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none placeholder-black text-xl p-6'
              type='email' required v-model="email" placeholder="E-mail" />
          </div>
          <div class='w-full mt-5'>
            <input
              class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 leading-tight text-gray-700 focus:border-gray-500 placeholder-black focus:bg-white focus:outline-none text-xl p-6'
              type='password' required v-model="password" placeholder="Senha" />
          </div>
          <div class="w-full mt-2" v-if="error.length != 0">
            <span class="text-base ms-1 text-red-400">Email e/ou senha incorretos.</span>
          </div>
          <div class="w-full text-right mb-2">
            <router-link class="text-base ms-4 cursor-pointer text-[#FFC90B]" to="/create">Crie um usuário
              aqui!</router-link>
          </div>
        </div>
        <button class="w-full bg-[#FFC90B] hover:bg-[#ffca0be5] p-6 rounded text-xl tx-[#333B65] font-bold"
          @click.prevent=login()>
          Entrar
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped></style>