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
                    <v-row class="mt-4">
                        <v-col cols="5">
                            <v-card height="500px" width="380px" fluid>
                                <span v-if="image_url === null" align-center justify-center><h3>Para una correcta visualización, se recomienda una resolucion de: <br> Alto: 500px <br> Ancho: 380px <br> o una escala proporcional</h3></span>
                                <v-img v-if="image_url !== null" :src="image_url" max-height="500px" max-width="380px"></v-img>
                            </v-card>
                            <v-file-input 
                                type="file" id="file" ref="file" v-on:change="handleFileUpload()"
                                style="display: none"
                                v-model="image_name"
                            >
                            </v-file-input>
                            <v-row class="mt-3">
                                <v-spacer></v-spacer>
                                <v-btn class="primary" @click="seleccionaImagen()">SUBIR IMAGEN</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn class="secondary" @click="borraImagen()">ELIMINAR IMAGEN</v-btn>
                                <v-spacer></v-spacer>
                            </v-row>
                        </v-col>
                        <v-col cols="1"></v-col>
                        <v-col cols="6">
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
                                        <v-text-field
                                            name="surname"
                                            label="Apellidos"
                                            type="text"
                                            v-model="var_apellidos"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            name="alias"
                                            label="Alias"
                                            type="text"
                                            v-model="var_alias"
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
                    <v-btn :disabled="!var_form" class="primary ma-2" @click="createJugador()">Guardar</v-btn>
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
            file: null,

            var_form: false,
            var_name: null,
            var_apellidos: null,
            var_alias: null,
            var_fecha: null,
            var_team_active : this.$store.getters.getTeamActive,
            var_ruta_imagen: null,

            dateMenu: false,
            dateValue: null,
        };
    },

    created() {
      this.initialize();
    },

    mounted: function() {
        
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

        seleccionaImagen() {
            this.$refs.file.$refs.input.click();
        },

        handleFileUpload(){
            this.image_url = URL.createObjectURL(this.image_name)
        },

        borraImagen() {
            this.image_url = null;
            this.image_name = null;
        },

        createJugador: function () {

            if (this.image_url !== null) {
                //SUBIR IMAGEN AL SERVIDOR
                this.uploadFile();
            }
            else {
                this.crearJugador();
            }
        },
        
        uploadFile: function () {
            let formData = new FormData();
            formData.append('file', this.image_name);
            formData.append('user', this.var_team_active)

                axios.post( '/api/player/upload-image',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                .then((response) => {
                    this.var_ruta_imagen = response.data.path;
                    this.crearJugador();
                })
                .catch((error) => {
                    alert("Error al subir la imagen");
                });
        },

        crearJugador: function () {
            let datos = {
                name: this.var_name,
                surname: this.var_apellidos,
                alias: this.var_alias,
                birthdate: this.dateValue,
                picture: this.var_ruta_imagen,
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