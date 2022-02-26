<template>

  <create-article v-show="$store.state.toggleCreateArticle"/>
  <transition name="anim">
    <ConnectionModal v-show="$store.state.toggleConnection"/>
  </transition>
  <MenuProfile v-show="$store.state.toggleProfileMenu"/>
  <HeaderConnected/>

  <ListOfArticles/>

</template>

<script>
import HeaderConnected from '@/components/HeaderConnected.vue';
import ListOfArticles from "@/components/ListOfArticles";
import ConnectionModal from '@/components/ConnectionModal.vue';
import MenuProfile from '@/components/MenuProfile.vue';
import CreateArticle from "@/components/CreateArticle";

export default {

  name: 'App',
  components: {
    ListOfArticles,
    HeaderConnected,
    ConnectionModal,
    MenuProfile,
    CreateArticle,
  },

  data() {
    return {
      user: {
        id: '',
        pseudo: '',
        mail: ''
      }
    }
  },

  beforeMount() {

  },

  methods: {},

  watch: {}
}

</script>

<style>

.articles-div {
  margin-top: 150px;
}

.anim-enter-active, .anim-leave-active {
  transition: opacity 0.20s ease-out;
}

.anim-enter, .anim-leave-to {
  opacity: 0;
}
</style>
