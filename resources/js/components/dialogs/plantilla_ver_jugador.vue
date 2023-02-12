<template>
    <div>
        <v-dialog v-model="dialog" persistent scrollable width="100%" height="100%">
            <v-card>
                <v-toolbar dense>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="cancel()" class="btn-close"
                        ><v-icon>mdi-close</v-icon></v-btn
                    >
                </v-toolbar>
                <v-card-text>
                    <v-row class="mt-3">
                        <v-spacer></v-spacer>
                        <v-btn icon @click="showEdit = true"><v-icon>edit</v-icon></v-btn>
                    </v-row>

                    <v-row>
                        <v-col cols="7" >
                            <v-container fluid fill-height>
                                <v-layout align-center justify-center>
                                    <span style="font-size:6em">{{this.alias}}</span>
                                </v-layout>
                            </v-container>
                        </v-col>
                        <v-col cols="2">
                                <v-img v-if="this.imagen" :src="this.imagen" height="auto" width="100%"></v-img><!--JUGADOR CON FOTO-->  
                                <v-img v-if="!this.imagen" src="images/icons/icon_no-face.png" height="auto" width="100%"></v-img><!--JUGADOR SIN FOTO-->      
                        </v-col>
                        <v-col cols="3">
                            <v-container fluid fill-height>
                                <v-layout align-center justify-center>
                                        <v-card>
                                            <v-row style="font-size:16em">{{this.dorsal}}</v-row>
                                        </v-card>
                                </v-layout>
                            </v-container>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6" class="pa-4">
                            <h1><u>Datos Personales</u></h1>
                            
                            <v-row>
                                <v-col cols="4" class="mt-4">
                                    <h2>Nombre Completo</h2>
                                    <h3>{{this.nombre}} {{this.apellidos}}</h3>
                                </v-col>    
                                <v-col cols="4" class="mt-4">
                                    <h2>Fecha de Nacimiento</h2>
                                    <h3>{{this.fecha}}</h3>
                                </v-col>   
                                <v-col cols="4" class="mt-4">
                                    <h2>Posicion</h2>
                                    <h3>{{this.posicion}}</h3>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4" class="mt-4">
                                    <h2>Altura</h2>
                                    <h3>{{this.altura}} cm</h3>
                                </v-col> 
                                <v-col cols="4" class="mt-4">
                                    <h2>Peso</h2>
                                    <h3>{{this.peso}} kg</h3>
                                </v-col>   
                            </v-row>
                        </v-col>
                        <v-col cols="6">
                            <h1><u>Estadisticas</u></h1>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-dialog>


        <editar_jugador
            v-bind:dialog="showEdit"
            v-bind:player="player"
        ></editar_jugador>
    
    </div>
</template>

<script>
import axios from "axios";
import moment from 'moment';

export default {
    props: ["dialog", "player"],
    name: "VerJugador",

    data() {
        return {
            showEdit: false,

            jugador_original: {},

            imagen: null,
            dorsal: null,
            nombre: null,
            apellidos: null,
            alias: null,
            fecha: null,
            posicion: null,
            altura: null,
            peso: null,
        };
    },

    created() {
      this.initialize();
    },

    mounted: function() {

    },

    watch: {
        "dialog"() {
            if (this.dialog) {
                this.jugador_original = this.player;
                
                this.imagen = this.player.player_face_route;
                this.dorsal = this.player.player_number;
                this.nombre = this.player.player_name;
                this.apellidos = this.player.player_surname;
                this.alias = this.player.player_alias.toUpperCase();
                this.fecha = moment(this.player.player_birthdate).format('DD/MM/YYYY');
                this.posicion = this.player.player_posicion;
                this.altura = this.player.player_height;
                this.peso = this.player.player_weight;
            }
        }
    },

    methods: {
        initialize: function () {

        }, 

        cancel: function () {
            this.$emit("cancel");
        },
    },    
};
</script>