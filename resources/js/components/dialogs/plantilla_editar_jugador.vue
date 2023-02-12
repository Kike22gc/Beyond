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
                                            v-model="player.player_name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-text-field
                                            name="surname"
                                            label="Apellidos"
                                            type="text"
                                            v-model="player.player_surname"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="6">
                                        <v-text-field
                                            name="alias"
                                            label="Alias"
                                            type="text"
                                            v-model="player.player_alias"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="6">
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
                                                :value="player.player_birthdate"
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
                                <v-row>
                                    <v-col cols="6">
                                        <v-text-field
                                            prepend-inner-icon="accessibility"
                                            name="altura"
                                            label="Altura"
                                            type="number"
                                            v-model="player.player_height"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            prepend-inner-icon="scale"
                                            name="Peso"
                                            label="Peso"
                                            type="number"
                                            v-model="player.player_weight"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="4">
                                        <v-text-field
                                            prepend-inner-icon="looks_one"
                                            name="dorsal"
                                            label="Dorsal"
                                            type="number"
                                            v-model="player.player_number"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-select
                                            style="font-size:1.5em"
                                            label="Posicion"
                                            v-model="player.player_posicion"
                                            :items="PosicionList"
                                            item-text="Posicion"
                                            item-value="Posicion"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    
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
    props: ["dialog", "player"],
    name: "EditarJugador",

    data() {
        return {
            image_url: null,
            image_name: null,
            file: null,

            var_form: false,
            var_team_active : this.$store.getters.getTeamActive,
            var_ruta_imagen: null,

            dateMenu: false,
            dateValue: null,

            PosicionList: [
                {
                "ID": "1",
                "Posicion": "Portero",
                },
                {
                "ID": "2",
                "Posicion": "Defensa",
                },
                {
                "ID": "3",
                "Posicion": "Centrocampista",
                },
                {
                "ID": "4",
                "Posicion": "Delantero",
                },
            ],
        };
    },

    created() {
      this.initialize();
    },

    mounted: function() {
        
    },

    watch: {
        dialog() {
            this.image_url = this.player.player_face_route;
            this.dateValue = this.player.player_birthdate;
        },
        dateValue(newValue) {
            const arrayFecha = newValue.split("-");
            this.player.player_birthdate = arrayFecha[2] + "/" + arrayFecha[1] + "/" + arrayFecha[0];
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

            if (this.image_url !== null && this.image_url !== this.player.player_face_route) {
                //SUBIR IMAGEN AL SERVIDOR
                this.uploadFile();
            }
            else {
                this.editarJugador();
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
                    this.editarJugador();
                })
                .catch((error) => {
                    alert("Error al subir la imagen");
                });
        },

        editarJugador: function () {
            let datos = {
                id: this.player.player_id,
                name: this.player.player_name,
                surname: this.player.player_surname,
                alias: this.player.player_alias,
                birthdate: this.dateValue,
                height: this.player.player_height,
                weight: this.player.player_weight,
                number: this.player.player_number,
                posicion: this.player.player_posicion,
                picture: this.var_ruta_imagen,
            };
            
            axios.post('/api/player/edit', datos).then((response) => {
                location.reload();
            })
            .catch((error) => {
                alert("Error al guardar la edicion del jugador");
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