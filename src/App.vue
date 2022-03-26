<template>

  <create-article v-show="$store.state.toggleCreateArticle"/>
  <HeaderConnected/>

</template>

<script>
import HeaderConnected from '@/components/HeaderConnected.vue';
import CreateArticle from "@/components/CreateArticle";

export default {

  name: 'App',
  components: {
    HeaderConnected,

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
}

</script>

<style>

body{
  background-color: red;
}

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
