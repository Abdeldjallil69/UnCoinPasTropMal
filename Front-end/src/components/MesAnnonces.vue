<template>
    <div class="annonces-container">
        <h1>Vos annonces</h1>
        <ul class="annonces-list">
            <li v-for="annonce in annonces" :key="annonce.id">
                <div class="annonce-item">
                    <div class="annonce-image">
                        <img :src="`/uploads/${annonce.Nom}.jpg`" alt="Image de l'annonce" />
                    </div>
                    <div class="annonce-details">
                        <div class="annonce-actions">
                            <h2 class="annonce-titre">{{ annonce.Nom }}</h2>
                            <div class="modification-section">
                                <label for="prixModifie">Prix:</label>
                                <input type="text" id="prixModifie" v-model="annonce.prixModifie"
                                    :placeholder="annonce.Prix">
                            </div>
                            <div class="modification-section">
                                <label for="descriptionModifie">Description:</label>
                                <textarea class="annonce-description" :value="annonce.Description" rows="4"></textarea>
                            </div>
                            <button class="btn-modifier" @click="modifierAnnonce(annonce)">Modifier</button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

  
<style scoped>
.modification-section {
    margin-bottom: 10px;
}

.modification-section label {
    display: block;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
}

.modification-section input,
.modification-section textarea {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-modifier {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-modifier:hover {
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
  
  
<script lang="ts">
import axios from 'axios';
import store from '../main';

export default {
    data() {
        return {
            annonces: []
        };
    },
    mounted() {
        const data = {
            idUti: store.getters.getIdUti
        };
        axios.post("http://localhost:3000/api/annonces", data)
            .then((response) => {
                this.annonces = response.data;
            })
            .catch((error) => {
                console.error(error);
            });
    },
    methods: {
        modifierAnnonce(annonce) {
            const data = new FormData();
            if (annonce.prixModifie !== annonce.Prix && annonce.descriptionModifie !== annonce.Description) {
                data.append('idAnnonce', annonce.id);
                data.append('prix', annonce.prixModifie);
                data.append('description', annonce.descriptionModifie);
            } else if (annonce.prixModifie !== annonce.Prix) {
                data.append('idAnnonce', annonce.id);
                data.append('prix', annonce.prixModifie);
            } else if (annonce.descriptionModifie !== annonce.Description) {
                data.append('idAnnonce', annonce.id);
                data.append('description', annonce.descriptionModifie);
            }

            axios.post("http://localhost:3000/api/annonces/modifier", data)
                .then((response) => {
                    this.refreshAnnonces();
                })
                .catch((error) => {
                    console.error(error);
                });

        },
        refreshAnnonces() {
            const data = {
                idUti: store.getters.getIdUti
            };
            axios.post("http://localhost:3000/api/annonces", data)
                .then((response) => {
                    this.annonces = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }
};
</script>
  