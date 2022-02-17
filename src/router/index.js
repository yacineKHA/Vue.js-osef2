import { createRouter, createWebHistory } from 'vue-router'
import Connection from '../components/ConnectionModal.vue'
import Articles from '../components/Articles.vue'
import createArticle from "@/components/CreateArticle";

const routes = [
  {
    path: '/',
    name: 'home',
    component: Articles,
    meta:{
      title: 'Home'
    }
  },
  {
    path: '/connection',
    name: 'Connection',
    component: Connection,
    meta:{
      title: 'Connection'
    }
  },
  {
    path: '/createArticle',
    name: 'createArticle',
    component: createArticle,
    meta:{
      title: 'Create Article'
    }
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.afterEach((to) =>{
  document.title = to.meta.title;
 })

export default router