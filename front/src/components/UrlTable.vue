<script>
export default {
  props: ['urls']
}
</script>

<template>
  <div>
    <table class="container mx-auto mt-20 border-2">
      <tr class="border-2">
        <th class="p-2 text-start border-2">URL</th>
        <th class="p-2 text-start border-2">Shortlink</th>
      </tr>
      <tr v-for="url, index in urls" :key="index" class="border-2">
        <td class="p-2 border-2">{{ url.original_url }}</td>
        <td class="p-2 border-2 cursor-pointer text-blue-500">
          <a :href="url.original_url">{{ url.shortener_url }}</a>
        </td>
      </tr>
    </table>
  </div>
</template>
