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
  <div class="container mx-auto flex flex-col justify-center items-center w-full max-w-xl h-screen">
    <div class="w-[500px]">
      <div class="cursor-pointer flex justify-start items-center">
        <router-link to="/">
          <Icon icon="material-symbols:arrow-back" color="#FFC90B" class="text-[40px]" />
        </router-link>
      </div>
      <h1 class="text-center my-4 text-white font-bold text-4xl mb-8">Cadastre-se rapidamente!</h1>
      <div className='flex flex-wrap'>
        <div class='w-full'>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none placeholder-black text-xl p-6'
            type='email' required v-model="email" placeholder="E-mail" />
          <span class="text-xs ms-1 mt-4 text-rose-500" v-if="error?.email">Email inválido.</span>
        </div>
        <div class='w-full mt-5'>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 leading-tight text-gray-700 focus:border-gray-500 placeholder-black focus:bg-white focus:outline-none text-xl p-6'
            type='password' required v-model="password" placeholder="Senha" />
          <span class="text-xs ms-1 mt-4 text-rose-500" v-if="error?.password">Senha deve ter 6 dígitos.</span>
        </div>
        <div class="w-full mt-2" v-if="error.length != 0">
          <span class="text-base ms-1 text-red-400">Email e/ou senha incorretos.</span>
        </div>
      </div>
      <button class="w-full bg-[#FFC90B] mt-4 hover:bg-[#ffca0be5] p-6 rounded text-xl tx-[#333B65] font-bold"
        @click.prevent=createUser()>
        Crie um usuário
      </button>
    </div>
  </div>
</template>

<style scoped></style>