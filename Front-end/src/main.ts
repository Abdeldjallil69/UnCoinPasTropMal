import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Vuex from 'vuex'
import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'


const app = createApp(App)

app.use(router)
app.use(Vuex);


const store = createStore({
    state: {
      nomUti:undefined,
      estConnecte: false,
      idUti:undefined
    },
    mutations: {
      connexion(state, payload) {
        state.estConnecte = true;
        state.nomUti = payload.pseudo;
        state.idUti = payload.id;
      },
      deconnexion(state) {
        state.estConnecte = false;
      },
      setNomUtiUndefined(state) {
        state.nomUti = undefined;
      }
    },
    actions: {
      seConnecter({commit},payload) {
        commit('connexion', payload);
      },
      seDeconnecter({ commit }) {
        commit('deconnexion');
      },
      resetNomUti({commit}) {
        commit('setNomUtiUndefined');
      }
    },
    getters: {
      estConnecte(state) {
        return state.estConnecte;
      },
      getNomUti(state) {
        return state.nomUti;
      },
      getIdUti(state) {
        return state.idUti;
      }
    },
    plugins: [createPersistedState()],
  })

  
app.use(store);
app.mount('#app')


export default store