<template>
    <v-container fluid>
        <v-card class="home" flat>
            <v-card-text>
                <v-row>
                    <v-col cols="4" class="pl-8">
                        <home_clasificacion></home_clasificacion>
                    </v-col>
                    <v-col cols="4" class="pl-8">
                        <home_partido></home_partido>
                    </v-col>
                    <v-col cols="4" class="pl-8">
                        <v-card>
                            <v-toolbar flat>
                                <v-card-title>CUADRO DERECHA</v-card-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-list>
                                    <v-list-item-group>
                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-title>XXXXXX</v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list-item-group>
                                </v-list>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import axios from "axios";
import home_clasificacion from './home_clasificacion.vue';
import home_partido from './home_partido.vue';

export default {
  components: { home_clasificacion, home_partido },

   name: 'Login',
   data() {
      return {

      }
   },

    created() {
        this.cargaInicial();
    },

    methods: {
        cargaInicial: function ()
        {
            this.cargaClasificacion();
            this.cargaCalendario();
        },

        cargaClasificacion: function ()
        {

        },

        cargaCalendario: function ()
        {
            
        },


   }

};
</script>