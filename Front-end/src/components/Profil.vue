<template>
    <form @submit.prevent="updateProfile" class="form">
        <div class="form-group">
            <label for="pseudo" class="label-left">Pseudo:</label>
            <input type="text" id="pseudo" v-model="pseudo">
        </div>
        <div class="form-group">
            <label for="password" class="label-left">Mot de passe:</label>
            <input type="password" id="password" v-model="password">
        </div>
        <div class="form-group">
            <label for="confirm-password" class="label-left">Confirmation du mot de passe:</label>
            <input type="password" id="confirm-password" v-model="cpassword">
            <p>
                {{ passwordDm }}
            </p>
        </div>
        <button type="submit">Modifier</button>
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

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
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
import store from '../main';
import axios from 'axios';

export default {
    data() {
        return {
            pseudo: '',
            password: '',
            cpassword: '',
            passwordDm: '',
        };
    },
    methods: {
        updateProfile() {
            this.passwordDm = '';
            const data = new FormData();
            const idUti = store.getters.getIdUti;
            data.append('idUti', idUti);

            if (this.password !== '') {
                if (this.password === this.cpassword) {
                    this.passwordDm = '';
                    data.append('password', this.password);
                } else {
                    this.passwordDm = 'Les mots de passe ne correspondent pas !';
                }
            }

            if (this.pseudo !== '') {
                data.append('pseudo', this.pseudo);
            }

            console.log('Contenu de FormData :');

            for (let pair of data.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }


            axios.post('http://localhost:3000/api/majProfil', data)
                .then((response) => {
                    console.log(response);
                    store.dispatch('seConnecter', { pseudo: this.pseudo, id: idUti })
                        .then(() => {
                            alert('Vos informations ont bien été mises à jour.');
                            this.$router.push('/');
                        })
                })
                .catch((error) => {
                    console.error(error);
                })
                ;
        },
    },
};
</script>
  