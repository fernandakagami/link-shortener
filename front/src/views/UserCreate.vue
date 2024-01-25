<script>
import { Icon } from '@iconify/vue';
import { instance } from "../services";

export default {
  components: {
    Icon,
  },
  data() {
    return {
      email: "",
      password: "",
      error: []
    }
  },
  methods: {
    createUser() {
      instance.post('user', {
        email: this.email,
        password: this.password
      }).then(() => {
        this.$router.push({
          path: '/'
        })
      }).catch((response) => {
        this.error = []
        this.error = response.response.data
        console.log(response)
      })
    }
  },
};
</script>

<template>
  <div class="container mx-auto mt-48 flex flex-col justify-start items-center w-full max-w-xl">
    <div class="border-2 w-[500px] rounded">
      <div class="my-4 flex  justify-center items-center relative">
        <div class="cursor-pointer absolute left-[23px] flex justify-center items-center">
          <Icon icon="material-symbols:arrow-back" color="#2563eb" />
          <router-link class="text-xs ms-1 text-[#2563eb] cursor-pointer" to="/">Voltar</router-link>
        </div>
        <h1 class="text-2xl text-center">Crie um usuário</h1>
      </div>
      <div className='mx-3 mb-6 flex flex-wrap'>
        <div class='w-full px-3'>
          <label class='mb-1 block uppercase tracking-wide text-lg'>
            E-mail
          </label>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none'
            type='email' required v-model="email" />
          <span class="text-xs ms-1 mt-4 text-rose-500" v-if="error?.email">Email inválido.</span>
        </div>
        <div class='w-full px-3 mt-5'>
          <label class='mb-1 block uppercase tracking-wide text-lg'>
            Senha
          </label>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none'
            type='password' required v-model="password" />
          <span class="text-xs ms-1 mt-4 text-rose-500" v-if="error?.password">Senha deve ter 6 dígitos.</span>
        </div>
      </div>
      <div class="my-6 flex justify-center items-center rounded cursor-pointer">
        <button class="bg-gray-500 text-white hover:bg=gray=700 py-2 px-20" @click.prevent="createUser()">Entrar</button>
      </div>
    </div>
  </div>
</template>

<style scoped></style>