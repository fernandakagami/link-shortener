<script>
import { useApi } from "../services";
import { Icon } from '@iconify/vue';

export default {
  props: ['urls'],

  data() {
    return {
      currentIndex: ''
    }
  },

  components: {
    Icon,
  },

  methods: {
    updateButton(index) {
      this.currentIndex = index
      this.$nextTick(() => {
        if (this.$refs.inputRef && this.$refs.inputRef[index]) {
          this.$refs.inputRef[index].focus();
        }
      });
    },
    updateUrl(id, url) {
      useApi().patch(`url/${id}`, {
        original_url: url
      }).then(() => {
        this.currentIndex = ''
      })
    },
    deleteUrl(id) {
      useApi().delete(`url/${id}`).then(() => {
        this.$emit('updatePage')
      })
    }
  }
}
</script>

<template>
  <div class="relative mt-20 max-w-3xl">
    <table class="w-full text-sm text-left rtl:text-right text-gray-300">
      <thead>
        <tr class="text-xs uppercase bg-[#FFC90B] text-white">
          <th scope="col" class="px-6 py-3">
            URL
          </th>
          <th scope="col" class="px-6 py-3">
            Link encurtado
          </th>
          <th scope="col" class="px-6 py-3">
            Ações
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="bg-white border-b border-gray-700" v-for="(url, index) in urls" :key="index">
          <th scope="row" class="px-6 py-4 font-medium text-ellipsis overflow-hidden text-white">
            <form v-if="currentIndex === index" @submit.prevent>
              <input class="w-[400px]" v-model=url.original_url type="text" ref="inputRef"
                @keyup.enter="updateUrl(url.id, url.original_url)">
            </form>
            <p class="w-[400px] truncate" v-else>{{ url.original_url }}</p>
          </th>
          <td class="px-6 py-4">
            <a :href="url.original_url">{{ url.shortener_url }}</a>
          </td>
          <td class="px-6 py-4 flex flex-row">
            <div @click="updateButton(index)">
              <Icon icon="mdi:pencil" width="25" height="25" color="#9dc0e2" class="cursor-pointer" />
            </div>
            <div @click="deleteUrl(url.id)">
              <Icon icon="material-symbols:close" width="30" height="30" color="red" class="cursor-pointer" />
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
