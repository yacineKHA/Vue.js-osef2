<template>
    <div class="conteneur">

            <div id="pseudo">
              <div id="imageProfile">
                <img src="../assets/babyYoga.jpeg" alt="profile Image">
              </div>
              <div id="nameProfile">

                <p>Yoda</p>
                <p>#FILMS</p>
                <p></p>
              </div>
            </div>
            <ul id="contenu">
                <li>
                    <div id="img">
                        <img src="" alt="article Image">
                    </div>
                    <div id="texte">

                    </div>
                </li>
            </ul>
            <div id="bottom">

            </div>
    </div>
</template>


<script>

    import axios from "axios";


    export default {
        name: "home",

        data(){
          return{
            user:{

            },

            articleId: [],
            articleTitle: [],
            articleText:[],
            articleImage:[],
            articleDate:[]

          }
        },

        methods:{

          getArticles(){
            axios.post('http://localhost/prj/osef-vue2/src/api/getArticles.php')
                .then((response) =>{
                  if (response.data){
                    this.articleId = response.data['idArticle'];
                    this.articleTitle = response.data['title'];
                    this.articleText = response.data['text'];
                    this.articleImage = "../../public/images"+ response.data['image'];
                    this.articleDate = response.data['date'];
                    console.log("Articles :"+response.data);
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
        },

        mounted() {
          this.methods.getArticles();
        }


    }

</script>


<style scoped>

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
}

#pseudo {
  display: flex;
  align-items: center;
  background-color: #56FFC2;
  background: linear-gradient(90deg, rgba(115,254,204,1) 0%, rgba(118,212,212,1) 51%, rgb(198, 162, 236) 100%);
  width: 100%;
  padding: 10px 10px;

}

#imageProfile{
  display: block;
  height: 50px;
  width: 60px;
  border-radius: 70px;
  background: #8c52ff;
  overflow: hidden;
  margin-right: 10px;
}

p{
  font-weight: bold;
}

#imageProfile img{
  margin: auto;
  width: auto;
  height: 55px;
  vertical-align: middle;
  margin-left: -10%;
}

#nameProfile{
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  width: 100%;
  height: 100%;
}

#nameProfile p:last-child{
  color: white;
}

#contenu {
  display: flex;
  width: 100%;
  height: 100%;
  overflow: hidden;
  word-wrap: break-word;
}

#texte {
  height: 300px;
  width: 100%;
  word-wrap: break-word;
  text-overflow: hidden;
}

#bottom{
  display: block;
  width: 100%;
  background-color: #56FFC2;
}

</style>