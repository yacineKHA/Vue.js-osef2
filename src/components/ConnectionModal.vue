<template>
  <div class="modal-window">

    <!--      <p id="message">{{this.message}}</p>-->
    <div class="overlay"></div>

    <div v-show="toggleForm" class="container">
      <img class="logo" src="../assets/logoOsef/logo5.svg" width="70" alt="Logo">

      <form action="" method="post">
        <h3>Se connecter</h3>

        <div class="div">
          <img src="../assets/email_black_36dp.png" height="72" alt="img">
          <input v-model="connection.email" class="emailCo" placeholder="Email" type="email" required>
        </div>
        <div class="div">
          <img src="../assets/lock_black_36dp.png" height="72" alt="img">
          <input v-model="connection.password" class="mdpCo" placeholder="Mot de passe" type="password" required>
        </div>
        <span v-show="span">Email ou mot de passe erroné !</span>

        <button @click="connectUser" class="btn btn-primary">Se connecter</button>
      </form>

      <p>Pas de compte ?</p>
      <button @click="switchToggleForm" class="inscription-button">S'inscrire ici</button>

    </div>

    <div v-show="!toggleForm" class="container">
      <div>
        <img class="logo" src="../assets/logoOsef/logo5.svg" width="70" alt="Logo">
        <h3 class="inscription">Inscription</h3>
      </div>

      <form action="" method="post">

        <div class="div">
          <img src="../assets/email_black_36dp.png" alt="img">
          <input v-model="registration.email" class="emailInput" placeholder="Email" type="email" required>
        </div>
        <div class="div">
          <img src="../assets/account_circle_black_48dp.svg" alt="img">
          <input v-model="registration.pseudo" class="pseudoInput" placeholder="Pseudo" type="text" required>
        </div>
        <div class="div">
          <img src="../assets/lock_black_36dp.png" alt="img">
          <input v-model="registration.password1" class="mdp" placeholder="Mot de passe" type="password" required>
        </div>
        <div class="div">
          <img src="../assets/lock_black_36dp.png" alt="img">
          <input v-model="registration.password2" class="mdp" placeholder="Confirmer mot de passe" type="password"
                 required>
        </div>
        <button @click="RegisterUser" class="btn btn-primary">S'inscrire</button>
      </form>

      <p>Déjà inscrit ?</p>
      <button @click="switchToggleForm" class="inscription-button">Se connecter ici</button>
    </div>

    <router-link to="/" class="x">
        X
    </router-link>

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
      span: false,

      message: "Je suis un message",

      connection: {
        email: "",
        password: ""
      },

      registration: {
        email: "",
        pseudo: "",
        password1: "",
        password2: "",
      },

      user: {
        id: "",
        pseudo: "",
        email: ""
      }
    }
  },

  watch: {
    message() {
      setInterval(() => {
        this.message = "r";
      }, 5000)
    }
  },

  methods: {
    switchToggleForm() {
      this.toggleForm = !this.toggleForm;

    },

    connectUser(e) {

      e.preventDefault();

      const formData = new FormData();

      formData.append('mail', this.connection.email);
      formData.append('mdp', this.connection.password);

      axios.post('http://localhost/prj/osef-vue2/src/api/index.php?url=connectionUser', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        },
      })
          .then((response) => {
            if (response.data) {

              localStorage.setItem('id', response.data[0]);
              localStorage.setItem('pseudo', response.data[1]);
              localStorage.setItem('mail', response.data[2]);

              console.log('session: ' + response.data[3]);
              this.span = false;
              this.store.commit('TOGGLE_CONNECTION_SWITCH');

              console.log("le post fonctionne : " + response.data);
              console.log("store user: " + store.state.user[1]);
              console.log("localStorage: " + localStorage.getItem('mail'));
              this.store.TOGGLE_CONNECTION_SWITCH();
              stop();
            } else {
              this.span = true;
              console.log("data est vide")
            }
          })
          .catch(function (error) {
            this.span = true;
            console.log("Poste marche pas: " + error);
          });
    },

    RegisterUser(e) {

      e.preventDefault();

      if (this.registration.password1 === this.registration.password2) {

        const formData = new FormData();

        formData.append('mailReg', this.registration.email);
        formData.append('pseudoReg', this.registration.pseudo);
        formData.append('password1', this.registration.password1);
        formData.append('password2', this.registration.password2);

        axios.post('http://localhost/prj/osef-vue2/src/api/index.php?url=registration', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          },
        })
            .then((response) => {
              if (response.data) {
                this.message = response.data;
                console.log("Inscription: " + response.data);
                stop();
              } else {
                console.log("data est vide");
              }
            })
            .catch(function (error) {
              console.log("Inscription ne fonctionne pas: " + error);
            });
      } else {
        console.log('Les mots de passes ne correspondent pas.');
      }
    }
  },
}
</script>

<style scoped>

router-link {
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

.container div:first-of-type {
  display: flex;
  align-items: center;
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

.div img {
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

span {
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
  border: lightgrey 1px solid;
}

/*#message{*/
/*  position: fixed;*/

/*  text-align: center;*/
/*  z-index: 100;*/
/*  width: 100%;*/
/*  height: 15%;*/
/*  display: flex;*/
/*  justify-content: center;*/
/*  align-items: center;*/
/*}*/

#message {
  z-index: 100;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50%;
  height: 6%;
  right: 25%;
  top: 100px;
  border: 9px solid #56FFC2;
  background-color: #8c52ff;
  color: white;
  font-weight: bold;
  font-size: large;
}

</style>