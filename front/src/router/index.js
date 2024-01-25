import { createRouter, createWebHistory } from 'vue-router';

import HomeView from "../views/HomeView.vue";
import LoginUser from "../views/LoginUser.vue";
import UserCreate from "../views/UserCreate.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginUser
    },
    {
      path: '/create',
      name: 'create',
      component: UserCreate
    },
    {
      path: '/home',
      name: 'home',
      component: HomeView
    },
  ]
})

export default router
