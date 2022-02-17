<template>
  <div id="first">
    <div @click="closeWindow" id="overlay">

    </div>
    <div id="articleWindow">
      <div>
        <div @click="closeWindow" id="x">X</div>
        <form action="" method="post" enctype="multipart/form-data" >
          <input v-model="this.title" type="text" placeholder="Titre" name="title">
          <input @change="fileSelected" accept="image/*" type="file" name="file">
          <input v-model="this.text" id="t" type="text" placeholder="Texte (falcultatif)" name="text">
          <button @click="createArticle">Publier</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "createArticle",

  data() {
    return {
      title: "",
      text: "",
      imgFile: "",

    }
  },

  methods: {
    closeWindow() {
      this.$store.dispatch('toggleCreateArticle');
    },

    createArticle(e) {
      console.log("create an article..");

      e.preventDefault();
      const formData = new FormData();

      formData.append('file', this.imgFile);
      formData.append('title', this.title);
      formData.append('text', this.text);

      axios.post('http://localhost/prj/osef-vue2/src/api/ArticleManager.php', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        },
      })
          .then(function (response) {
            console.log("reponnnnse: " + response);
            console.log("title: ");
            console.log("response : " + response.data);
          })
          .catch(function (error) {
            console.log("Poste marche pas: " + error);
          });
    },

    fileSelected(event) {
      console.log(event);
      this.imgFile = event.target.files[0];
      console.log(this.imgFile);
      //event.target.files = localisation des informations sur l'image uploadée.
    }
  }
}
</script>

<style scoped>

#first {
  background-color: green;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  position: fixed;
}

#overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.75);
  z-index: 2;
}

#articleWindow {
  position: absolute;
  display: flex;
  flex-direction: column;
  height: 90%;
  width: 90%;
  background-color: white;
  border-radius: 10px;
  z-index: 3;
}

#articleWindow div {
  display: flex;
  flex-direction: column;
}

#x {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: lightgrey;
  width: 50px;
  height: 50px;
  border-radius: 30px;
  font-weight: bolder;
  font-size: 25px;
}

#x:hover {
  cursor: pointer;
}

form {
  display: flex;
  flex-direction: column;
}

#t {
  height: 600px;
  width: 500px;
}

</style>