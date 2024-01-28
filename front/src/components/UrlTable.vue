<script>
export default {
  props: ['urls']
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
        </tr>
      </thead>
      <tbody>
        <tr class="bg-white border-b border-gray-700" v-for="url in urls">
          <th scope="row" class="px-6 py-4 font-medium text-ellipsis overflow-hidden text-white">
            {{ url.original_url }}
          </th>
          <td class="px-6 py-4">
            <a :href="url.original_url">{{ url.shortener_url }}</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
