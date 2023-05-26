<template>
    <form @submit.prevent="AjouterAnnonce" class="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom" class="label-left">Nom :</label>
            <input type="text" id="pseudo" v-model="nom" required>
        </div>
        <div class="form-group">
            <label for="description" class="label-left">Description :</label>
            <input type="description" id="description" v-model="description" required>
        </div>
        <div class="form-group">
            <label for="prix" class="label-left">Prix (en €) :</label>
            <input type="text" id="prix" v-model="prix" required>
        </div>
        <div class="form-group">
            <label for="photo" class="label-left">Photo de l'objet :</label>
            <input type="file" id="photo" ref="photoInput" accept=".jpg,.jpeg,.png" @change="handleFileChange" required>
        </div>
        <button type="submit">Soumettre l'annonce</button>
    </form>
</template>
  
<style scoped>
.form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 300px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group {
    margin-bottom: 10px;
}

.label-left {
    margin-bottom: 5px;
}

button[type="submit"] {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

p {
    margin: 5px 0;
}
</style>


  
<script lang="ts">
import store from '@/main';
import axios from 'axios';

export default {
    data() {
        return {
            nom: '',
            description: '',
            prix: '',
            idUti: undefined,
            photo: undefined
        };
    },
    methods: {
        handleFileChange(event) {
            this.photo = event.target.files[0];
        },
        AjouterAnnonce() {
            const idUtiFs = store.getters.getIdUti;
            this.idUti = idUtiFs;
            const formData = new FormData();
            formData.append('nom', this.nom);
            formData.append('description', this.description);
            formData.append('prix', this.prix);
            formData.append('idUti', this.idUti);
            formData.append('photo', this.photo);
            console.log(formData);
            axios.post('http://localhost:3000/api/ajouterAnnonce', formData)
                .then((response) => {
                    alert("L'annonce a été crée avec succés ! Félicitations !")
                    this.$router.push('/');
                })
                .catch((error) => {
                    console.error(error);
                })
                ;
        }
    }
};
</script>
  