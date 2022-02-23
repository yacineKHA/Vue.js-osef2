<template>

  <create-article v-show="$store.state.toggleCreateArticle"/>
  <transition name="anim">
    <ConnectionModal v-show="$store.state.toggleConnection"/>
  </transition>
  <MenuProfile v-show="$store.state.toggleProfileMenu"/>
  <HeaderConnected/>
  <section>
    <div></div>
    <div class="articles-div">
      <Articles/>
    </div>
    <div></div>

  </section>

</template>

<script>
import HeaderConnected from './components/HeaderConnected.vue';
import Articles from './components/Articles.vue';
import ConnectionModal from './components/ConnectionModal.vue';
import MenuProfile from './components/MenuProfile.vue';
import CreateArticle from "@/components/CreateArticle";



export default {

  name: 'App',
  components: {
    CreateArticle,
    HeaderConnected,
    Articles,
    ConnectionModal,
    MenuProfile
  },

  data() {
    return {
      user:{
        id: '',
        pseudo:'',
        mail:''
      }
    }
  },

  beforeMount() {

  },

  methods: {

  },

  watch:{

  }
}

</script>

<style>

section {
  display: grid;
  grid-template-columns: 1fr 60% 1fr;
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
