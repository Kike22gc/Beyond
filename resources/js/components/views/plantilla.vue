<template>
    <v-app id="inspire">
        <v-main>
            <v-container fluid fill-height>
                <v-layout justify-center>
                <v-flex md10>
                    <v-card class="ma3">
                        <v-toolbar flat>
                            <v-card-title style="font-size:2.5em"><u>PLANTILLA</u></v-card-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-card-title>EQUIPO: XXXXXXX</v-card-title>
                        </v-card-text>
                    </v-card>
                    <v-card>
                        <v-toolbar flat>
                            <v-card-title style="font-size:2.5em"><u>JUGADORES</u></v-card-title>
                            <v-spacer></v-spacer>
                            <v-icon x-large color="primary" class="ma-4" @click="newPlayer()">person_add</v-icon>
                        </v-toolbar>
                        <v-card-text>
                            <v-row>
                                <v-col cols="3"
                                v-for="(n, index) in listPlayers" 
                                :key="index"
                                >
                                <v-card height="520px">
                                    <v-img v-if="listPlayers[index].player_face_route == null" src="images/icons/icon_no-face.png" height="450px" width="100%"></v-img><!--JUGADOR SIN FOTO-->
                                    <v-img v-if="listPlayers[index].player_face_route != null" :src="listPlayers[index].player_face_route" height="450px" width="100%"></v-img><!--JUGADOR CON FOTO-->
                                    <v-card-title>
                                        <v-spacer></v-spacer>
                                            <span v-if="listPlayers[index].player_alias === null" >
                                                {{ listPlayers[index].player_number }} - {{ listPlayers[index].player_name }} {{ listPlayers[index].player_surname }}
                                            </span>
                                            <span v-if="listPlayers[index].player_alias !== null" >
                                                {{ listPlayers[index].player_number }} - {{ listPlayers[index].player_alias }}
                                            </span> 
                                        <v-spacer></v-spacer>
                                    </v-card-title>
                                </v-card>
                                </v-col>
                            </v-row>   
                        </v-card-text>
                    </v-card>
                </v-flex>
                </v-layout>
            </v-container>
        </v-main>

        <nuevo_jugador
            v-bind:dialog="showNewPlayer"
            @cancel="cancel"
        ></nuevo_jugador>

    </v-app>
</template>

<script>
import axios from "axios";

export default {
    name: "Home",

    data() {
        return {
            team_active: null,
            showNewPlayer: false,

            listPlayers: [],

        };
    },

    created() {
        this.team_active = this.$store.getters.getTeamActive;
        this.initialize();
    },

    mounted() {
    },

    methods: {
        initialize : function() {
            this.getPlayersByTeamID();
        },

        getPlayersByTeamID: function () {

            let datos = {
                team_active: this.team_active,
            };

            axios.post('/api/player/getPlayers', datos).then((response) => {
                this.listPlayers = response.data;
            })
            .catch((error) => {
                alert("Error al cargar el escudo de la federacion");
            });
        },

        newPlayer: function() {
            this.showNewPlayer = true;
        },

        cancel: function () {
            this.showNewPlayer = false;
        }
    },
    
};
</script>

