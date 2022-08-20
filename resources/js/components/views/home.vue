<template>
   <v-app id="inspire">
      <v-main>
         <Home_calendario v-if="this.teams.length > 0"></Home_calendario>
         <Home_bottom v-if="this.teams.length > 0"></Home_bottom>
         <Team_nuevo
            v-bind:dialog="showNewTeam"
         ></Team_nuevo>
      </v-main>
   </v-app>
</template>

<script>
import Home_calendario from '../fragments/home/home_calendario.vue';
import Home_bottom from '../fragments/home/home_bottom.vue';

import axios from "axios";
import Team_nuevo from '../dialogs/team_nuevo.vue';

export default {
    name: "Home",
    components: { Home_calendario, Home_bottom, Team_nuevo },

    data() {
        return {
            showNewTeam: false,
            teams: [],
        };
    },

    created() {
      this.initialize();
    },

    mounted() {
    },

    methods: {
      initialize: function () {
         axios.get('/api/user/getTeams').then((response) => {
            this.teams = response.data;

            if(this.teams.length == 0) {this.showNewTeam = true}
         })
         .catch((error) => {
            alert("Error al cargar equipos del usuario");
         });
      }
    },
    
};
</script>