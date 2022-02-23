import { createRouter, createWebHistory } from 'vue-router';


const routes = [
  {
    path: '/',
    name: 'home',
    component: ()=>
        import("../components/Articles.vue"),
    meta:{
      title: 'Home'
    }
  },
  {
    path: '/connection',
    name: 'Connection',
    component: ()=>
        import("../components/ConnectionModal.vue"),
    meta:{
      title: 'Connection'
    }
  },
  {
    path: '/createArticle',
    name: 'createArticle',
    component: ()=>
        import("@/components/CreateArticle.vue"),
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