<template>
   <v-app id="inspire">
      <v-main>

      </v-main>
   </v-app>
</template>

<script>

import axios from "axios";

export default {
    name: "Home",

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

      }
    },
    
};
</script>