<script>
</script>

<template>
  <div class="container mx-auto mt-48 flex flex-col justify-start items-center w-full max-w-xl">
    <div class="border-2 w-[500px] rounded">
      <h1 class="text-2xl text-center my-4">Encurtador de links</h1>
      <hr class="mb-5">
      <div className='mx-3 mb-6 flex flex-wrap'>
        <div class='w-full px-3'>
          <label class='mb-1 block uppercase tracking-wide text-gray-700 text-lg'>
            URL
          </label>
          <input
            class='block w-full appearance-none rounded border border-gray-50 bg-gray-50 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none'
            type='text' placeholder="https://www.youtube.com/watch?v=vbyDU5YnNXQ" required />
          <span class="text-xs ms-1 text-rose-500">Esta URL não é válida</span>
        </div>
      </div>
      <div class="my-6 mx-10 flex justify-center items-center border-2 py-2 rounded cursor-pointer">
        <button>Criar</button>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
