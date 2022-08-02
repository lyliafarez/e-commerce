<template>
    <div
   
    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
  >
    <div class="flex-1 flex justify-between sm:hidden">
      <a
        :href="results.prev_page_url"
        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
      >
        Précédent
      </a>
      <a
        :href="results.next_page_url"
        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
      >
        Suivant
      </a>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Affiche
          {{ " " }}
          <span class="font-medium">{{ results.from }}</span>
          {{ " " }}
          à
          {{ " " }}
          <span class="font-medium">{{ results.to }}</span>
          {{ " " }}
          de
          {{ " " }}
          <span class="font-medium">{{ results.total }}</span>
          {{ " " }}
          résultats
        </p>
      </div>
      <div>
        <nav
          class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <div
            v-for="link in results.links"
            :key="link"
          >
            <button
              v-if="link.url === null"
              class="bg-gray-300 border-gray-300 text-gray-500 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
              disabled
              v-html="link.label"
            />
            <a
              v-else
              class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
              :class="{
                'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium':
                  link.active,
              }"
              :href="link.url"
              v-html="link.label"
            />
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
export default {
        props: ['results']
}
</script>
<style>
    
</style>