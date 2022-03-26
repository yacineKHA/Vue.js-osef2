<template>
  <section >
    <div id="overlay" @click="$store.commit('TOGGLE_PROFILE_MENU')"></div>
    <div id="menu">

      <ul>
        <div>
          <img src='../assets/account_circle_black_48dp.png'>
          <span>Bonjour {{this.user.pseudo}}</span>
        </div>
        <li><img src='../assets/account_circle_black_48dp.png'><router-link to="/MyProfile">Mon profil</router-link></li>
        <li><img src='../assets/manage_accounts_black_48dp.svg'>Paramètres du compte</li>
        <li><img src='../assets/list_bulleted_black_48dp.svg'>Mes posts</li>
        <li><img src='../assets/help_outline_black_48dp.svg'>Help ?</li>
        <li @click="disconnect" id="disconnect"><img src='../assets/logout_black_48dp.svg'>Se déconnecter</li>
      </ul>
    </div>
  </section>
</template>

<script>
import store from "@/store";

export default {

  data() {
    return {
      componentKey:0,
      user: {
        id: store.state.user.id,
        pseudo: store.state.user.pseudo,
        email: store.state.user.email
      }
    }
  },

  methods:{
    disconnect(){
      localStorage.clear();
      location.reload();
      stop();
    },
  },

  watch: {
    user() {
      return this.user;
    }
  }
}

</script>

<style scoped>

div{
  margin: 0;
  padding: 0;
}

#menu {
  display: flex;
  flex-direction: column;
  background: white;
  position: fixed;
  color: black;
  width: 300px;
  right: 7px;
  border-radius: 10px;
  box-shadow: 5px 14px 30px 2px rgba(0, 0, 0, 0.274);
  top: 67px;
  z-index: 3;
}

#menu::before{
  content: "";
  display:block;
  width: 30px;
  height: 20px;
  background-color: white;
  position: absolute;
  transform: rotate(45deg);
  left:80%;
  top: -1.4%;
}

#overlay {
  position: fixed;
  display: block;
  width: 100%;
  height: 100%;
  background-color: rgba(17, 17, 17, 0.21);
  z-index: 2;
}


ul{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin: 0;
  padding: 0;
}

ul div{
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 125px;
}

ul li img{
  height: 25px;
  margin-right: 5px;
}

ul li{
  display: flex;
  align-items: center;
  padding: 15px;
  cursor: pointer;
  font-size: 1.2rem;
  border-bottom: 1px solid rgba(128, 128, 128, 0.13);
  list-style: none;
  width: 100%;
}

ul li:first-of-type{
  border-top: 2px solid lightgrey;
}

ul li:last-child{
  border-top: 2px solid lightgrey;
}

li:hover {
  border-left: 10px solid #56FFC2;
  background-color: rgba(140, 82, 255, 0.04);
  transition: 0.2s;
  font-weight: bolder;
  color: #1f6049;
}

#disconnect {
  font-weight: bolder;
}

</style>