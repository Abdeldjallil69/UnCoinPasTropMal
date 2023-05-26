<template>
    <form @submit.prevent="signUp" class="form">
        <div class="form-group">
            <label for="pseudo" class="label-left">Pseudo:</label>
            <input type="text" id="pseudo" v-model="pseudo" required>
        </div>
        <div class="form-group">
            <label for="email" class="label-left">Email:</label>
            <input type="email" id="email" v-model="email" required>
        </div>
        <div class="form-group">
            <label for="password" class="label-left">Mot de passe:</label>
            <input type="password" id="password" v-model="password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password" class="label-left">Confirmation du mot de passe:</label>
            <input type="password" id="confirm-password" v-model="cpassword" required>
            <p>
                {{ passwordDm }}
            </p>
        </div>
        <button type="submit">S'inscrire</button>
        {{ emailAu }}
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
            nom: '',
            id: '',
            pseudo: '',
            email: '',
            password: '',
            cpassword: '',
            passwordDm: '',
            emailAu: ''
        };
    },
    methods: {
        signUp() {
            console.log('Pseudo:', this.pseudo);
            console.log('Email:', this.email);
            console.log('Mot de passe:', this.password);
            console.log('Conf mdp:', this.cpassword);

            this.emailAu = '';

            if (this.password === this.cpassword) {
                this.passwordDm = '';
                const dataIns = {
                    email: this.email,
                    pseudo: this.pseudo,
                    password: this.password
                };
                axios.post('http://localhost:3000/api/inscription', dataIns)
                    .then((response) => {
                        if (response.data.inscription) {
                            console.log("Inscription réussi");
                            const dataCo = {
                                pseudo: this.pseudo,
                                id: response.data.idUti
                            };
                            console.log(dataCo);
                            store.dispatch('seConnecter', dataCo)
                                .then(() => {
                                    this.$router.push('/');
                                })
                                .catch((error: string) => {
                                    console.log(error);
                                });
                        } else if (!response.data.inscription) {
                            this.emailAu = 'Cette adresse mail est déjà utilisé. Veuillez vous connecter svp';
                        }
                    })
                    .catch((error) => {
                        console.error(error);
                    })
                    ;
            } else {
                this.passwordDm = 'Les mots de passe ne correspondent pas !';
            }
        },
    },
};
</script>
  