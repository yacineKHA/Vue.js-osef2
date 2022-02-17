<template>
  <div class="modal-window">

    <div class="overlay"></div>

    <div v-show="toggleForm" class="container">
      <img class="logo" src="../assets/logoOsef/logo5.svg" width="70" alt="Logo">

      <form action="" method="post">
        <h3>Se connecter</h3>

        <div class="div">
          <img src="../assets/email_black_36dp.png" height="72" alt="img">
          <input v-model="emailInput" class="emailCo" placeholder="Email" type="text" required>
        </div>
        <div class="div">
          <img src="../assets/lock_black_36dp.png" height="72" alt="img">
          <input v-model="passwordInput" class="mdpCo" placeholder="Mot de passe" type="password" required>
        </div>
        <span v-show="span">Email ou mot de passe erroné !</span>
        <router-link to="/">
          <button @click="connectUser" class="btn btn-primary">Se connecter</button>
        </router-link>
      </form>

      <p>Pas de compte ?</p>
      <button @click="switchToggleForm" class="inscription-button">S'inscrire ici</button>

    </div>

    <div v-show="!toggleForm" class="container">
      <img class="logo" src="../assets/logoOsef/logo5.svg" width="70" alt="Logo">

      <form action="" method="post">
        <h3>Inscription</h3>
        <div class="div">
          <img src="../assets/email_black_36dp.png" alt="img">
          <input class="emailInput" placeholder="Email" type="text" required>
        </div>
        <div class="div">
          <img src="../assets/account_circle_black_48dp.svg" alt="img">
          <input class="pseudoInput" placeholder="Pseudo" type="text" required>
        </div>
        <div class="div">
          <img src="../assets/lock_black_36dp.png" alt="img">
          <input class="mdp" placeholder="Mot de passe" type="password" required>
        </div>
        <div class="div">
          <img src="../assets/lock_black_36dp.png" alt="img">
          <input class="mdp" placeholder="Confirmer mot de passe" type="password" required>
        </div>
        <button class="btn btn-primary">S'inscrire</button>
      </form>

      <p>Déjà inscrit ?</p>
      <button @click="switchToggleForm" class="inscription-button">Se connecter ici</button>
    </div>

    <div @click="$store.commit('TOGGLE_CONNECTION_SWITCH')" class="x">
      <router-link to="">X</router-link>
    </div>

  </div>

</template>

<script>

import axios from "axios";
import store from "@/store";
// import {mapState} from "vuex";


export default {

  name: "Modal",

  data() {
    return {
      toggleForm: true,
      span:false,
      emailInput: "",
      passwordInput: "",
      user:{
        id: "",
        pseudo: "",
        email:""
      }
    }
  },

  mounted() {

  },

  methods: {
    switchToggleForm() {
      this.toggleForm = !this.toggleForm;

    },

    connectUser(e){
      e.preventDefault();

      axios.post('http://localhost/prj/osef-vue2/src/api/UserConnection.php', {
        mail: this.emailInput,
        mdp: this.passwordInput,})
          .then((response) =>{
            if (response.data){
              // store.dispatch('setId', response.data);
              store.dispatch('setUserId', response.data[2]);

              localStorage.setItem('id', response.data[0]);
              localStorage.setItem('pseudo', response.data[1]);
              localStorage.setItem('mail', response.data[2]);

              console.log('session: ' + response.data[3]);
              this.span = false;
              location.reload();
              console.log("le post fonctionne : "+ response.data);
              console.log("store user: "+ store.state.user[1]);
              console.log("localStorage: "+ localStorage.getItem('mail'));
              this.store.TOGGLE_CONNECTION_SWITCH();
              stop();
            } else {
              this.span = true;
              console.log("data est vide")
            }
          })
          .catch(function (error){
            this.span = true;
            console.log("Poste marche pas: "+error);
          });
    }

    //url axios 'http://localhost/prj/osef-vue2/src/components/bdd.php'
    //   getUsers(){
    //     axios.get('http://localhost/prj/osef-vue2/src/api/bdd.php')
    //     .then(response=>{
    //
    //       console.log(response.data);
    //       this.user = response.data;
    //     })
    //     .catch(e =>{
    //       console.log(e + " ça ne marche pas");
    //     })
    //   }
  },

  computed:{

  }
}

</script>

<style scoped>

router-link{
  width: 100%;
}

.modal-window {
  height: 100%;
  width: 100%;
  position: fixed;
  display: flex;
}

.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: white;
  height: 550px;
  width: 600px;
  border-radius: 15px;
  /*box-shadow: 5px 5px 15px 5px rgba(0, 0, 0, 0.274);*/
  margin-top: 170px;
  z-index: 4;
  box-shadow: 5px 7px 0 2px #8c52ff;
}

.x {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 45px;
  width: 45px;
  margin-top: 140px;
  background-color: rgb(255, 255, 255);
  font-weight: bolder;
  border-radius: 50px;
  z-index: 4;
}

.x:hover {
  cursor: pointer;
}

form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-content: center;
}

.div {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid black;
  margin-top: 25px;
  height: 40px;
}

.div img{
  height: 25px;
  margin-left: 10px;
}

.div:focus-within {
  border: 2px solid black;
}

input {
  border: 0;
  padding-left: 10px;
  height: 100%;
  width: 350px;
  outline: none;
}

h3 {
  font-size: xx-large;
  text-align: center;
}

form button {
  margin-top: 25px;
  border: 0;
  height: 40px;
  background-color: black;
}

form button:hover {
  background-color: #8c52ff;
}

span{
  color: red;
  font-weight: bolder;
}

.overlay {
  position: absolute;
  height: 100%;
  width: 100%;
  background: linear-gradient(139deg, rgba(86, 255, 193, 1) 30%, rgba(140, 82, 255, 1) 90%);
  z-index: 3;
  background: #56FFC2;
}

p {
  margin-top: 40px;
}

.inscription-button {
  border: 0;
  background-color: white;
  font-weight: bolder;
}

</style>