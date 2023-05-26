<template>
    <div>
        <footer class="footer">
            <img src="../../assets/github.png" alt="logo-github" id="github-logo" />
            <a href="https://github.com/Abdeldjallil69" id="github-link" target="_blank">Github</a>
            <h1 style="position: fixed; left: 90%; top: 93%;">
                {{ getNomUti == undefined ? `Visiteur` : getNomUti }}
            </h1>
        </footer>
    </div>
</template>

<style scoped>
.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 60px;
    background-color: #252323b9;
}

#github-link {
    position: inherit;
    left: 10%;
}

#github-logo {
    position: inherit;
    width: 20px;
    height: 20px;
    left: 8%;
}
</style>

<script lang="ts">
import { useStore } from 'vuex'

export default {
    computed: {
        getNomUti() {
            return this.$store.getters.getNomUti;
        }
    }
}
</script>