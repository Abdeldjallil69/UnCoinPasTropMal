<template>
    <form @submit.prevent="login" class="form-group">
        <div>
            <label for="email">Email:</label>
            <input type="email" class="input-email" id="email" v-model="email" required>
            <div id="emailErreur">
                {{ emailError }}
            </div>
        </div>
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" class="input-password" id="password" v-model="password" required>
            <div id="passwordErreur">
                {{ passwordError }}
            </div>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</template>

<style scoped>
.input-email,
.input-password {
    display: block;
}
</style>

<script lang="ts">
import store from '../main'
import axios from 'axios'


export default {
    data() {
        return {
            email: '',
            password: '',
            emailError: '',
            passwordError: ''
        };
    },
    methods: {
        login() {
            const data = {
                email: this.email,
                password: this.password
            };

            axios.get('http://localhost:3000/api/utilisateurs', {
            })
                .then(response => {
                    console.log('La requête a réussi! ');

                    if (response.data[0].email == this.email) {
                        this.emailError = '';
                        if (response.data[0].password == this.password) {
                            this.passwordError = '';
                            const data = {
                                pseudo: response.data[0].pseudo,
                                id: response.data[0].id
                            };
                            store.dispatch('seConnecter', data)
                                .then(() => {
                                    this.$router.push('/');
                                })
                                .catch((error: string) => {
                                    console.log(error);
                                });
                        } else {
                            this.passwordError = "Le mot de passe ou l'adresse mail ne sont pas valides. Veuillez vérifier les identifiants.";
                        }
                    } else {
                        this.emailError = "L'adresse mail n'est pas valide, avez-vous un compte ?";
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>
