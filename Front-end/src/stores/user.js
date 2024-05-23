import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', () => {
  
    const isLoggedIn = ref(localStorage.getItem('isLoggedIn'))

  return { isLoggedIn }
})
