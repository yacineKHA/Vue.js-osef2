<template>
<!--  <div v-for="article in articles" :key="article['idArticle']" class="conteneur">-->
<!--    <div  id="img">-->
<!--      <img :src="`/images/${article.image}`" :alt="article['image']">-->
<!--    </div>-->
<!--    <div id="pseudo">-->
<!--      <div id="imageProfile">-->
<!--        <img :src="`../../public/images/${article.image}`" alt="profile Image">-->
<!--      </div>-->
<!--      <div id="nameProfile">-->
<!--        <p>Pseudo</p>-->
<!--        <p>#FILMS</p>-->
<!--        <p>{{ article.date }}</p>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div id="contenu">-->
<!--      <h3 id="title">{{ article.title }}</h3>-->
<!--&lt;!&ndash;      <p id="texte">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores cum delectus dolore doloribus numquam&ndash;&gt;-->
<!--&lt;!&ndash;        possimus. Ab amet animi consectetur deleniti exercitationem facilis, illum molestias, nobis obcaecati, placeat&ndash;&gt;-->
<!--&lt;!&ndash;        similique tenetur veritatis.&ndash;&gt;-->
<!--&lt;!&ndash;      </p>&ndash;&gt;-->

<!--    </div>-->
<!--    -->
<!--  </div>-->
  <div class="card" v-for="article in articles" :key="article['idArticle']" style="width: 80%;">
    <img class="card-img-top" :src="`/images/${article.image}`" :alt="article['image']">
    <div class="card-body">
      <h5 class="card-title">{{ article.title }}</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <div id="nameProfile">
        <p>Pseudo</p>
        <p>#FILMS</p>
        <p>{{ article.date }}</p>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";

export default {
  name: "article",

  data() {
    return {
      articles: [],
    }
  },

  methods: {
    getArticles() {
      return axios.get('http://localhost/prj/osef-vue2/src/api/index.php?url=getAllArticles')
          .then((response) => {
            if (response.data) {
              this.articles = response.data;
              console.log("Articles :" + response.data);
              stop();
            } else {
              this.span = true;
              console.log("data est vide")
            }
          })
          .catch(function (error) {
            this.span = true;
            console.log("Post ne marche pas: " + error);
          });
    }
  },

  beforeMount() {
    this.getArticles();
  }
}

</script>


<style scoped>

.card{
  margin-bottom: 80px;
}

.conteneur {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 400px;
  text-overflow: hidden;
  word-wrap: break-word;
  border: 1px solid rgba(38, 37, 37, 0.05);
  margin-bottom: 110px;
  background-color: white;
  /*overflow: hidden;*/
}

.conteneur:hover{
  border: none;
  box-shadow: 7px 7px 0px 0px #56FFC2;
  transform: scale(1.03);
}

#pseudo {
  display: flex;
  text-align: center;
  justify-content: center;
  align-items: center;
  /*background: #56FFC2 linear-gradient(90deg, rgba(115, 254, 204, 1) 0%, rgba(118, 212, 212, 1) 51%, rgb(198, 162, 236) 100%);*/
  background-color: #56FFC2;
  width: 100%;
  height: 50px;
  padding: 10px 10px;
}

#imageProfile {
  display: inline-block;
  height: 30px;
  width: 30px;
  border-radius: 50%;
  background: black;
  overflow: hidden;
  margin-right: 4px;
  vertical-align: middle;

  /*display: inline-block;*/
  /*height: 20px;*/
  /*margin-right: 4px;*/
  /*vertical-align: middle;*/
  /*width: 20px;*/
}

p {

}

#imageProfile img {
  object-fit: contain;
  /*width: auto;*/
  /*height: 55px;*/
  /*vertical-align: middle;*/
  /*margin: auto auto auto -10%;*/
}

#nameProfile {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  width: 100%;
  height: 100%;
}

#nameProfile p:last-child {
  color: white;
}

#contenu {
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100%;
  overflow: hidden;
  word-wrap: break-word;
}

#title{
  text-align: center;
  font-weight: bold;
  font-size: larger;
  font-family: "Comic Sans MS",serif;
}

#texte {
  height: 300px;
  width: 100%;
  word-wrap: break-word;
  text-overflow: hidden;
  color: grey;
}

#img{
  background-color: white;
  width: 100%;
  height: 100%;
}

img{
  width: 100%;
  height: 100%;
  object-fit: scale-down;
}

#bottom{
  background-color: #56FFC2;
  height: 70px;
  width: 100%;
}

</style>