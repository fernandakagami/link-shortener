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
  <div class="container mx-auto mt-48 flex flex-col justify-start items-center w-full max-w-xl">
    <div class="border-2 w-[500px] rounded">
      <h1 class="text-2xl text-center my-4">Login</h1>
      <div className='mx-3 mb-6 flex flex-wrap'>
        <div class='w-full px-3'>
          <label class='mb-1 block uppercase tracking-wide text-lg'>
            E-mail
          </label>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none'
            type='text' required v-model="email" />
        </div>
        <div class='w-full px-3 mt-5'>
          <label class='mb-1 block uppercase tracking-wide text-lg'>
            Senha
          </label>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none'
            type='password' required v-model="password" />
        </div>
        <div class="w-full" v-if="error.length != 0">
          <span class="text-xs ms-4 mt-4 text-rose-500">Email e/ou senha incorretos.</span>
        </div>
        <div class="w-full text-right">
          <router-link class="text-xs ms-4 text-blue-500 cursor-pointer" to="/create">Crie um usuário aqui!</router-link>
        </div>
      </div>
      <div class="my-6 flex justify-center items-center rounded cursor-pointer">
        <button class="bg-gray-500 text-white hover:bg=gray=700 py-2 px-20" @click.prevent="login()">Entrar</button>
      </div>
    </div>
  </div>
</template>

<style scoped></style>