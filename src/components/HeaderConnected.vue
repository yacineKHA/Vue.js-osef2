<template>

  <div id="header">
    <div id="logoWithName">
      <img id="logo" src="../assets/logoOsef/logo5.svg" width="50px" alt="Logo">
      <h2>Dysit</h2>
    </div>

    <div id="searchBox">
      <img src="../assets/search_black_24dp.svg" alt="search">
      <input type="text" placeholder="Rechercher...">
    </div>
    <p>{{$store.state.user.email}}</p>
    <img v-if="$store.state.user.id !== null" @click="toggleProfileMenu" id="imgProfile" src="../assets/account_circle_black_48dp.svg"
         alt="image profile">
    <router-link v-else @click="$store.commit('TOGGLE_CONNECTION_SWITCH')" id="button" to="/connection">
      Se connecter
    </router-link>
  </div>


    <router-link to="/createarticle">
      <div @click="openCreateArticle" v-show="$store.state.user.id !== null && !$store.state.toggleCreateArticle" id="addArticle">
        +
      </div>
    </router-link>

  <MenuProfile v-show="$store.state.toggleProfileMenu"/>

  <router-view></router-view>

</template>

<script>
import MenuProfile from '@/components/MenuProfile.vue';

    export default {
        name:'headerTop',

        components: {
          MenuProfile,
        },

        methods:{
          toggleProfileMenu(){
            this.$store.dispatch('toggleProfileMenu');
          },

          openCreateArticle(){
            this.$store.dispatch('toggleCreateArticle');
          }
        }
    }
</script>


<style scoped>

#header {
  position: fixed;
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 65px;
  width: 100%;
  background-color: #56FFC2;
  /*background: #56FFC2 linear-gradient(180deg, #56FFC2 0%, rgba(140, 82, 255, 0.4) 100%);*/
}

#logoWithName{
  display: flex;
  justify-content: center;
  align-items: center;
}

#logo {
  margin-left: 30px;
  margin-right: 5px;
}

#searchBox {
  display: flex;
  align-items: center;
  background: white;
  max-width: 700px;
  width: 50%;
  height: 35px;
}

#searchBox img {
  padding: 0 5px;
}

input {
  outline: none;
  width: 100%;
  border: 0;
}

#searchBox:focus-within {
  border: 2px solid black;
}

#button {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: black;
  height: 100%;
  width: 140px;
  text-decoration: none;
  color: white;
  font-weight: bold;
}

#button:hover {
  box-shadow: 3px 3px black;
  background: #8c52ff;
  transition-duration: 0.4s;
}

#imgProfile {
  margin-right: 30px;
}

#imgProfile:hover {
  cursor: pointer;
}
#addArticle{
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
}

/*#addArticle {*/
/*  display: flex;*/
/*  justify-content: center;*/
/*  align-items: center;*/
/*  position: fixed;*/
/*  width: 60px;*/
/*  height: 60px;*/
/*  bottom: 25px;*/
/*  right: 25px;*/
/*  font-size: 3em;*/
/*  color: #56FFC2;*/
/*  font-weight: bolder;*/
/*  border-radius: 30px;*/
/*  background: white linear-gradient(145deg, #ffffff, #cecece);*/
/*  box-shadow:  15px 15px 30px #bfbfbf, -15px -15px 30px #ffffff;*/
/*  z-index:1*/
/*}*/

/*#addArticle p{*/
/*  text-shadow: 2px 2px 0 #8c52ff, -2px -2px 6px white;*/
/*}*/

/*#addArticle:hover{*/
/*  cursor: pointer;*/
/*  background: #ffffff;*/
/*  box-shadow: inset 25px 5px 30px #bfbfbf, inset -15px -15px 30px #ffffff;*/
/*  border: 10px solid rgba(0, 0, 0, 0.42);*/
/*  transition: 2s;*/
/*}*/

</style>
