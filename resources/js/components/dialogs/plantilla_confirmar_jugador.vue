<template>
    <div>
        <v-dialog v-model="dialog" persistent scrollable width="20%">
            <v-card>
                <v-toolbar dense>
                    <v-icon x-large v-if="(mensaje == 'edit')">check</v-icon>
                    <v-toolbar-title v-if="(mensaje == 'edit')" class="ml-4">Confirmar Cambios</v-toolbar-title>
                    <v-icon x-large v-if="(mensaje != 'edit')">clear</v-icon>
                    <v-toolbar-title v-if="(mensaje != 'edit')" class="ml-4">Descartar Cambios</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="cancel()" class="btn-close"
                        ><v-icon>mdi-close</v-icon></v-btn
                    >
                </v-toolbar>
                <v-card-text>
                    <span v-if="(mensaje == 'edit')" class="ma-4"> <h2>¿Desea guardar los cambios?</h2></span>
                    <span v-if="(mensaje != 'edit')" class="ma-4"> <h2>¿Desea descartar los cambios?</h2></span>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="confirm()" color="primary">SI</v-btn>
                    <v-btn @click="cancel()" color="secondary">NO</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>    
    </div>
</template>

<script>
    import axios from "axios";
    
    export default {
    props: ["dialog", "mensaje"],
        name: "ConfirmEditPlayer",
    
        data() {
            return {

            };
        },

        methods: {
            initialize: function () {

            }, 

            confirm: function () {
                if(this.mensaje == "edit") {
                    this.$emit("guardar");
                }
                else {
                    this.$emit("descartar");
                }
            },  

            cancel: function () {
                this.$emit("cancel");
            },  
        }
    };
</script>