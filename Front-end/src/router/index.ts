import { createRouter, createWebHistory } from 'vue-router'
import VueRouteur from 'vue-router'
import Acceuil from '@/components/Acceuil.vue'
import Connexion from '../components/Connexion.vue'
import Inscription from '../components/Inscription.vue'
import Contact from '../components/Contact.vue'
import CreationAnnonce from '../components/CreationAnnonce.vue'
import Annonces from '../components/Annonces.vue'
import Achat from '../components/Achat.vue'
import Profil from '../components/Profil.vue'
import MesAnnonces from '../components/MesAnnonces.vue'
import { before } from 'node:test'
import store from '@/main'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path:'/:catchAll(.*)',
      redirect:'/'
    },
    {
      path: '/',
      name: 'home',
      component: Acceuil
    },
    {
      path: '/connexion',
      name: 'connexion',
      component: Connexion,
      beforeEnter: (to, from, next) => {
        if(!store.getters.estConnecte) {
          next();
        } else {
          next('/');
        }
      }
    },
    {
      path: '/inscription',
      name: 'inscription',
      component: Inscription,
      beforeEnter: (to, from, next) => {
        if(!store.getters.estConnecte) {
          next();
        } else {
          next('/');
        }
      }
    },
    {
      path: '/creation',
      name: 'creation',
      component: CreationAnnonce,
      beforeEnter: (to, from, next) => {
        if(store.getters.estConnecte) {
          next();
        } else {
          next('/');
        }
      }
    },
    {
      path: '/achat',
      name: 'achat',
      component: Achat,
      beforeEnter: (to, from, next) => {
        if(store.getters.estConnecte) {
          next();
        } else {
          next('/');
        }
      }
    },
    {
      path: '/profil',
      name: 'profil',
      component: Profil,
      beforeEnter: (to, from, next) => {
        if(store.getters.estConnecte) {
          next();
        } else {
          next('/');
        }
      }
    },
    {
      path: '/mesAnnonces',
      name: 'mesAnnonces',
      component: MesAnnonces,
      beforeEnter: (to, from, next) => {
        if(store.getters.estConnecte) {
          next();
        } else {
          next('/');
        }
      }
    },
    {
      path: '/annonces',
      name: 'annonces',
      component: Annonces,
      beforeEnter: (to, from, next) => {
        if(store.getters.estConnecte) {
          next();
        } else {
          next('/');
        }
      }
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    },
  ]
})

export default router
