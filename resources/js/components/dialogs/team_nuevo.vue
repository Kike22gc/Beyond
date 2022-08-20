<template>
    <div>
        <v-dialog v-model="dialog" persistent scrollable max-width="50%">
            <v-card>
                <v-toolbar dense>
                    <v-icon x-large>add_circle_outline</v-icon>
                    <v-toolbar-title class="ml-4">Añadir Nuevo Equipo</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="cancel" class="btn-close"
                        ><v-icon>mdi-close</v-icon></v-btn
                    >
                </v-toolbar>
                <v-card-text>
                    <v-row>
                        <v-col cols="8">
                            <v-select
                                style="font-size:1.5em"
                                class="ma-7"
                                label="Federacion"
                                v-model="federacion"
                                :items="federacionesList"
                                item-text="federacion_name"
                                item-value="federacion_id"
                            ></v-select>
                            <v-select
                                style="font-size:1.5em"
                                class="ma-7"
                                label="Club"
                                v-model="club"
                                :disabled="!federacion"
                                :items="clubesList"
                                :item-text="item => item.Club_ID +' - '+ item.Club_Nombre"
                                item-value="Club_ID"
                            ></v-select>
                            <v-select
                                style="font-size:1.5em"
                                class="ma-7"
                                label="Equipo"
                                v-model="equipo"
                                :disabled="!club"
                                :items="equiposList"
                                item-text="Equipo_Nombre"
                                item-value="ID"
                            ></v-select>
                        </v-col>
                        <v-col cols="4">
                            <img 
                                v-if="this.federacion_img && !this.club" 
                                width="auto" 
                                height="240px" 
                                class="mt-7 ml-11"
                                v-bind:src="'/images/federaciones/' + this.federacion_img "
                            />
                            <img 
                                v-if="this.federacion_img && this.club_img" 
                                width="240px" 
                                height="240px" 
                                class="mt-7 ml-7"
                                v-bind:src="'/images/escudos/' + this.club_img + '.png' "
                            />
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="primary ma-2" @click="createTeam()">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["dialog"],
    name: "Home",

    data() {
        return {
            federacionesList: [],
            federacion: null,
            federacion_img: null,

            clubesList: [
                {
                "ID": "1",
                "Club_Nombre": "Real Madrid C.F.",
                "Club_ID": "1001"
                },
                {
                "ID": "2",
                "Club_Nombre": "C.F. Fuenlabrada",
                "Club_ID": "3944"
                },
                
            ],
            club: null,
            club_img: null,

            equiposList: [
                {
                "ID": "1",
                "Equipo_Nombre": "Juvenil",
                },
                {
                "ID": "2",
                "Equipo_Nombre": "Cadete",
                },
            ],
            equipo: null,
        };
    },

    created() {
      this.initialize();
    },

    mounted() {

    },

    watch: {
        federacion() {
            this.getFedImgByID();
            this.club = null;
            this.club_img = null;
        },

        club() {
            this.club_img = this.club;
        }
    },

    methods: {
        initialize: function () {
            axios.get('/api/fed/getAll').then((response) => {
                this.federacionesList = response.data;
            })
            .catch((error) => {
                alert("Error al cargar federaciones");
            });
        }, 

        getFedImgByID: function () {

            let datos = {
                federacion: this.federacion,
            };

            axios.post('/api/fed/getLogoByID', datos).then((response) => {
                this.federacion_img = response.data.federacion_logo;
            })
            .catch((error) => {
                alert("Error al cargar el escudo de la federacion");
            });
        },

        createTeam: function () {
            let datos = {
                federacion: this.federacion,
                club: this.club,
            };

            axios.post('/api/team/create', datos).then((response) => {
                location.reload();
            })
            .catch((error) => {
                alert("Error al crear el equipo para el usuario");
            });
        },

        cancel: function () {
            this.$emit("cancel");
        },
    },
    
    
};
</script>