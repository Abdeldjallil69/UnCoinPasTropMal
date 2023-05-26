<template>
  <div>
    <header class="header">
      <a href="/">
        <img src="../../assets/home.png" alt="Home" id="accueil-link" />
      </a>
      <template v-if="!estConnecte">
        <a href="/Connexion" class="header-link" id="connexion-link">Connexion</a>
        <a href="/Inscription" class="header-link" id="inscription-link">Inscription</a>
      </template>
      <template v-if="estConnecte">
        <a href="/MesAnnonces" class="header-link" id="mesAnnonces-link" style="left: 65%">Mes annonces</a>
        <a href="/Profil" class="header-link" id="profil-link" style="left: 73%">Profil</a>
        <a href="/Annonces" class="header-link" id="annonces-link" style="left: 7%">Annonces</a>
        <a href="/Achat" class="header-link" id="achat-link" style="left: 16%">Achats</a>
        <a href="/Creation" class="header-link" id="creation-link" style="left: 78%">Ajouter une annonce</a>
        <a href="/Contact" class="header-link" id="contact-link" style="left: 88%">Contact</a>
        <a @click="deconnexion" class="header-link" id="contact-link" style="left: 93%">Deconnexion</a>
      </template>
      <template v-else>
        <a href="/Contact" class="header-link" id="contact-link" style="left: 55%">Contact</a>
      </template>

    </header>
  </div>
</template>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 60px;
  background-color: #f5f5f537;
}

.header-link {
  text-align: center;
  color: white;
  border-radius: 4px;
  background-color: #0a257715;
  border-width: 3px;
  border-color: white;
  padding: 15px 17px;
  top: 4px;
}

#accueil-link {
  position: fixed;
  width: 60px;
  height: 60px;
}

#connexion-link {
  position: sticky;
  left: 10%;
  width: 50%;
}

#inscription-link {
  position: sticky;
  left: 35%;
}

#contact-link {
  position: sticky;

}

#creation-link {
  position: sticky;
}

#annonces-link {
  position: sticky;
}

#achat-link {
  position: sticky;
}

#profil-link {
  position: sticky;
}

#mesAnnonces-link {
  position: sticky;
}

.header-link:hover {
  border-width: 1%;
  border: 1px solid;
  text-align: center;
}
</style>

<script>
export default {
  computed: {
    estConnecte() {
      return this.$store.getters.estConnecte;
    },
  },
  methods: {
    deconnexion() {
      this.$store.dispatch('resetNomUti');
      this.$store.dispatch('seDeconnecter');
      this.$router.push('/');
    },
  },
};
</script>

