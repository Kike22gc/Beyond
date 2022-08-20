<template>
    <div>
        <v-app-bar>
            <v-btn x-large text @click="toHome()">Inicio</v-btn>
            <v-btn x-large text @click="toPlantilla()">Plantilla</v-btn>
            <v-btn x-large text @click="toHome()">Competición</v-btn>
            <v-btn x-large text @click="toHome()">Calendario</v-btn>
            
            <v-spacer></v-spacer>

            <v-avatar
                size="46"
                class="mr-2"
                v-if="this.$store.getters.isUserLogged"
            >
                <v-icon x-large>account_circle</v-icon>
            </v-avatar>
            <v-row
                max-width="100"
                class="d-block flex-grow-0"
                no-gutters
                md="auto"
                v-if="this.$store.getters.isUserLogged"
            >
                <v-col class="d-flex font-weight-bold text-caption">
                    {{ this.$store.getters.getUserName }}
                </v-col>

                <v-col class="text-caption">
                    NOMBRE DEL CLUB - Infantil "A"
                </v-col>
            </v-row>

            <v-app-bar-nav-icon
                class="ml-5"
                @click="drawer = true"
                v-if="this.$store.getters.isUserLogged"
            ></v-app-bar-nav-icon>
        </v-app-bar>
        
        <v-navigation-drawer v-model="drawer" absolute temporary right>
        
            <v-list nav dense>
                <v-list-item-group v-model="group" active-class="deep-purple--text text--accent-4">
                    <v-list-item @click="editProfile()">
                        <v-list-item-icon>
                            <v-icon>manage_accounts</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Editar perfil</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="logout()">
                        <v-list-item-icon>
                            <v-icon>mdi-logout</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Cerrar sesión</v-list-item-title>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Header",

    data() {
        return {
            drawer: false,
            group: null,
        };
    },

    mounted() {},

    methods: {
        toHome: function () {
            this.$router.push("/home");
        },

        toPlantilla: function () {
            this.$router.push("/plantilla");
        },

        logout() {
            this.$store.dispatch("setLogout");
            this.$router.push("/");
        },
    },
};
</script>
