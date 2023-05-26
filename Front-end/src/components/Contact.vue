<template>
    Page de contact
</template>

<script lang="ts">
import { useStore } from 'vuex';

export default {
    created() {
        const store = useStore();
        // Utilisez le store ici pour accéder à l'état, aux getters, aux mutations, aux actions, etc.
        console.log(store.state); // Exemple d'accès à l'état du store
    }
};
</script>