<template>

  <div id="header">
    <img id="logo" src="../assets/logoOsef/logo5.svg" width="50" alt="Logo">
    <div id="searchBox">
      <img src="../assets/search_black_24dp.svg" alt="search">
      <input type="text" placeholder="Rechercher...">
    </div>

    <router-link @click="$store.commit('TOGGLE_CONNECTION_SWITCH')" id="button" to="/connection">Se connecter
    </router-link>
  </div>

</template>

<script>

export default {
  name: 'headerTop',
}

</script>


<style scoped>

#header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 65px;
  width: 100%;
  background-color: #56FFC2;
}

#logo {
  margin-left: 30px;
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

a {
  height: 100%;
  width: 100%;
  background-color: #56FFC2;
}

</style>