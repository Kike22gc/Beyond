<template>
    <div>
        <v-dialog v-model="dialog" persistent scrollable max-width="50%">
            <v-card>
                <v-toolbar dense>
                    <v-icon x-large>add_circle_outline</v-icon>
                    <v-toolbar-title class="ml-4">Añadir Nuevo Jugador</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="cancel()" class="btn-close"
                        ><v-icon>mdi-close</v-icon></v-btn
                    >
                </v-toolbar>
                <v-card-text>
                    <v-row class="mt-5">
                        <v-col cols="4">
                            <v-img :src="image_url" height="auto" width="100%"></v-img>
                            <v-file-input 
                                @change="Preview_image"
                                label="Haz click para subir una foto"
                                v-model="image_name"
                                width="150px"
                            >
                            </v-file-input>
                        </v-col>
                        <v-col cols="8">
                            <v-card-text>
                              <v-form v-model="var_form">
                                <v-row>
                                    <v-col cols="6">
                                        <v-text-field
                                            name="name"
                                            label="Nombre"
                                            type="text"
                                            v-model="var_name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            name="name"
                                            label="Apellidos"
                                            type="text"
                                            v-model="var_apellidos"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12">
                                        <v-menu
                                            v-model="dateMenu"
                                            :close-on-content-click="false"
                                            :nudge-right="40"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="290px"
                                            max-width="290px"
                                        >
                                            <template v-slot:activator="{on}">
                                            <v-text-field
                                                prepend-inner-icon="event"
                                                readonly
                                                hide-details
                                                label="Fecha de Nacimiento"
                                                :value="var_fecha"
                                                v-on="on"
                                            ></v-text-field>
                                            </template>
                                            <v-date-picker
                                                locale="es-ES"
                                                :first-day-of-week="1"
                                                v-model="dateValue"
                                                no-title
                                                @input="dateMenu = false"
                                            ></v-date-picker>
                                        </v-menu>
                                    </v-col>
                                </v-row>
                              </v-form>
                            </v-card-text>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="primary ma-2" @click="createJugador()">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["dialog"],
    name: "NuevoJugador",

    data() {
        return {
            image_url: null,
            image_name: null,

            var_form: false,
            var_name: null,
            var_apellidos: null,
            var_fecha: null,
            var_team_active : this.$store.getters.getTeamActive,

            dateMenu: false,
            dateValue: null,
        };
    },

    created() {
      this.initialize();
    },

    mounted() {

    },

    watch: {
        dateValue(newValue) {
            const arrayFecha = newValue.split("-");
            this.var_fecha = arrayFecha[2] + "/" + arrayFecha[1] + "/" + arrayFecha[0];
        }
    },

    methods: {
        initialize: function () {
            this.var_team_active = this.$store.getters.getTeamActive;
        }, 

        Preview_image() {
            this.image_url= URL.createObjectURL(this.image_name)
        },  

        createJugador: function () {

            let datos = {
                name: this.var_name,
                surname: this.var_apellidos,
                birthdate: this.dateValue,
                picture: this.image_url,
                team_active: this.var_team_active,
            };

            axios.post('/api/player/create', datos).then((response) => {
                location.reload();
            })
            .catch((error) => {
                alert("Error al crear el equipo para el usuario");
            });
        },

        cancel: function () {
            this.image_url = null;
            this.image_name = null;
            this.$emit("cancel");
        },
    },
    
    
};
</script>