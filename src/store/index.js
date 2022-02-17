import {createStore} from "vuex";
import axios from "axios";


export default createStore({

    state: {
        toggleConnection: false,
        toggleProfileMenu: false,
        toggleHeaderSwitch: false,
        toggleCreateArticle: false,

        user:{
            id: localStorage.getItem('id'),
            pseudo: localStorage.getItem('pseudo'),
            email: localStorage.getItem('mail'),
        },

        userID: '',

    },

    mutations: {
        TOGGLE_CONNECTION_SWITCH(state) {
            state.toggleConnection = !state.toggleConnection;
            console.log("TOGGLE_CONNECTION_SWITCH = Ok");
        },

        TOGGLE_PROFILE_MENU(state) {
            state.toggleProfileMenu = !state.toggleProfileMenu;
            console.log("switch toggleProfileMenu: " + state.toggleProfileMenu);
        },

        TOGGLE_HEADER_SWITCH(state){
            state.toggleHeaderSwitch = !state.toggleHeaderSwitch;
        },

        TOGGLE_CREATE_ARTICLE(state){
            state.toggleCreateArticle = !state.toggleCreateArticle;
        },

        SET_ID(state, payload){
            state.user = payload;
        },

        GET_USER(email, mdp) {

            axios.post('http://localhost/prj/osef-vue2/src/api/getUser.php', {
                mail: email,
                mdp: mdp,})
                .then(function (response){
                    console.log("le post ca marche: "+response);
                })
                .catch(function (error){
                    console.log("Poste marche pas: "+error);
                })
            axios.get('http://localhost/prj/osef-vue2/src/api/getUser.php')
                .then(response => {
                    console.log(response.data);
                    this.user = response.data;
                })
                .catch(e => {
                    console.log(e + " ca marche pas");
                })
        },

        SET_USER_ID(state, payload){
            state.userID = payload;
        }
    },

    actions: {
        toggleConnectionSwitch(context) {
            context.commit('TOGGLE_CONNECTION_SWITCH');
            console.log("ca marche action");
        },

        toggleProfileMenu(context){
            context.commit('TOGGLE_PROFILE_MENU');
        },

        toggleCreateArticle(context){
            context.commit('TOGGLE_CREATE_ARTICLE');
            console.log("OpenCreateArticle")
        },

        setId(context, payload){
            context.commit('SET_ID', payload);
        },

        setUserId(context, payload){
            context.commit('SET_USER_ID', payload);
        }
    },

    getters: {},

    modules: {}
})