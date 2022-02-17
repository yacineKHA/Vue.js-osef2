<template>
    <div id="conteneur">
        
            <div id="pseudo">
              <div id="imageProfile">
                <img src="../assets/babyYoga.jpeg" alt="profile Image">
              </div>
              <div id="nameProfile">

                <p>Yoda</p>
                <p>#FILMS</p>
                <p>Il y 4h</p>
              </div>
            </div>
            <ul id="contenu">
                <li>
                    <div id="img">
                        <img src="" alt="article Image">
                    </div>
                    <div id="texte">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat porro eos blanditiis cupiditate explicabo? Obcaecati blanditiis asperiores natus nostrum ut placeat vero eveniet nesciunt similique, omnis nemo! Alias, esse explicabo!
                        Id ducimus, nostrum adipisci ab voluptatum saepe sed facilis animi dolorum quod nemo vitae corrupti doloremque debitis aliquam! Repellat ex odio necessitatibus sapiente velit dicta animi aliquam adipisci quae minima?
                        Voluptate blanditiis quos minus facere nam eaque ipsam neque, quo illum voluptatem consectetur consequatur fugit perferendis rerum amet. Quisquam perspiciatis reprehenderit incidunt numquam aliquid eveniet reiciendis maxime, cum labore ratione.
                    </div>
                </li>
            </ul>
            <div id="bottom">

            </div>
    </div>
</template>


<script>

    import axios from "axios";
    import store from "@/store";

    export default {
        name: "home",
        data(){
          return{

          }
        },

        methods:{

          getArticles(){


            axios.get('http://localhost/prj/osef-vue2/src/api/getArticles.php', {
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
        }

    }

</script>


<style scoped>

#conteneur {
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