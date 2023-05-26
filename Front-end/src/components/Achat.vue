<template>
    <div class="annonces-container">
        <h1>Vos achats effectués</h1>
        <ul class="annonces-list" v-if="annonces.length > 0">
            <li v-for="annonce in annonces" :key="annonce.id">
                <div class="annonce-item">
                    <div class="annonce-image">
                        <img :src="`/uploads/${annonce.Nom}.jpg`" alt="Image de l'annonce" />
                    </div>
                    <div class="annonce-details">
                        <h2 class="annonce-titre">{{ annonce.Nom }}</h2>
                        <p class="annonce-description">{{ annonce.Description }}</p>
                        <p class="annonce-prix">Prix : {{ annonce.Prix }} €</p>
                        <h4 class="annonce-vendeur">Vendeur : {{ annonce.vendeur }}</h4>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="annonces-list" v-else>
            <h2>
                Vous n'avez pas encore effectué d'achats. Rendez vous dans l'onglet Annonces pour claquer votre biff !
            </h2>
        </ul>
    </div>
</template>
  
<style scoped>
.btn-achat {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-achat:hover {
    background-color: #0056b3;
}

.annonces-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.annonces-list {
    list-style: none;
    padding: 0;
}

.annonce-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    background-color: #f7f7f7;
}

.annonce-image {
    flex: 0 0 auto;
    margin-right: 20px;
}

.annonce-image img {
    max-width: 250px;
    max-height: 250px;
}

.annonce-details {
    flex: 1 1 auto;
}

.annonce-titre {
    font-size: 24px;
    margin: 0 0 10px;
    color: #333;
}

.annonce-description {
    font-size: 18px;
    margin: 0;
    color: #666;
}

.annonce-prix {
    font-size: 20px;
    margin: 10px 0 0;
    font-weight: bold;
    color: #ff5722;
}

.annonce-vendeur {
    font-size: 18px;
    margin: 0;
    color: #666;
}
</style>
  
  
<script>
import axios from 'axios';
import store from '../main';

export default {
    data() {
        return {
            annonces: []
        };
    },
    mounted() {
        axios.get("http://localhost:3000/api/annonces")
            .then((response) => {
                const idUti = store.getters.getIdUti;
                this.annonces = response.data.filter((annonce) => annonce.acheteurId == idUti);
            })
            .catch((error) => {
                console.error(error);
            });
    },
    methods: {

    }
};
</script>
  