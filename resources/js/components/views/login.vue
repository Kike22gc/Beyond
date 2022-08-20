<template>
   <v-app id="inspire">
      <v-main>
         <v-container fluid fill-height>
            <v-layout align-center justify-center>
               <v-flex md8>
                  <v-card class="elevation-12">
                     <v-row>
                        <v-col width="40%" v-show="var_showScreen == 'signup'">
                           <img width="100%" height="auto" src="images/login.png"/>
                        </v-col>
                        <v-col class="mt-auto mb-auto" width="60%">
                           <v-card-text >
                              <v-form v-model="var_form">
                                 <v-row class="ma-1">
                                    <v-text-field
                                       v-if="var_showScreen != 'login'"
                                       prepend-icon="person"
                                       name="name"
                                       label="Nombre Completo"
                                       type="text"
                                       v-model="var_name"
                                       :rules="[rules.required]"
                                    ></v-text-field>
                                 </v-row>
                                 <v-row class="ma-1">
                                    <v-text-field
                                       prepend-icon="person"
                                       name="email"
                                       label="Email"
                                       type="text"
                                       v-model="var_email"
                                       :rules="[rules.required, rules.email]"
                                    ></v-text-field>
                                 </v-row>
                                 <v-row class="ma-1">
                                    <v-text-field
                                       id="password"
                                       prepend-icon="lock"
                                       name="Contraseña"
                                       label="Contraseña"
                                       type="password"
                                       v-model="var_password"
                                       :rules="[rules.required]"
                                    ></v-text-field>
                                    <v-text-field
                                       v-if="var_showScreen != 'login'"
                                       id="confirm_password"
                                       prepend-icon="lock"
                                       name="Repetir Contraseña"
                                       label="Repetir Contraseña"
                                       type="password"
                                       v-model="var_confirm_password"
                                       :rules="[rules.required, rules.confirm]"
                                    ></v-text-field>
                                 </v-row>
                                 <v-row class="ma-1" v-if="var_showScreen != 'login'">
                                    <v-col class="ml-5">
                                       <v-btn v-if="var_sub_type == 1" color="warning" x-large @click="var_sub_type = 1"> 1 Equipo <br> 10€/Año</v-btn>
                                       <v-btn v-if="var_sub_type != 1" color="primary" x-large @click="var_sub_type = 1"> 1 Equipo <br> 10€/Año</v-btn>
                                    </v-col>
                                    <v-col class="ml-5">
                                       <v-btn v-if="var_sub_type == 2" color="warning" x-large @click="var_sub_type = 2"> 2 Equipos <br> 16€/Año</v-btn>
                                       <v-btn v-if="var_sub_type != 2" color="primary" x-large @click="var_sub_type = 2"> 2 Equipos <br> 16€/Año</v-btn>
                                    </v-col>
                                    <v-col class="ml-5">
                                       <v-btn v-if="var_sub_type == 3" color="warning" x-large @click="var_sub_type = 3"> 3 Equipos <br> 18€/Año</v-btn>
                                       <v-btn v-if="var_sub_type != 3" color="primary" x-large @click="var_sub_type = 3"> 3 Equipos <br> 18€/Año</v-btn>
                                    </v-col>
                                 </v-row>
                                 <v-text-field
                                       v-if="'a'!='a'"
                                       v-model="var_sub_type"
                                       :rules="[rules.required]"
                                    ></v-text-field>
                              </v-form>
                           </v-card-text>
                           <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn v-if="var_showScreen == 'login'" color="primary" :disabled= !var_form @click="login()">Iniciar Sesion </v-btn>
                              <v-btn v-if="var_showScreen != 'login'" color="primary" :disabled= !var_form @click="signUp()">Registrarse </v-btn>
                           </v-card-actions>
                        </v-col>
                        <v-col width="40%" v-show="var_showScreen == 'login'">
                           <img width="100%" height="auto" src="/images/login.png"/>
                        </v-col>
                     </v-row>
                     <v-row align-center>
                        <v-col v-show="var_showScreen == 'signup'">
                           <div class="text-center">
                              <v-btn
                                 class="ma-2"   
                                 outlined
                                 color="primary"
                                 @click="changeshow()" 
                              >INICIAR SESION</v-btn>
                           </div>
                        </v-col>
                        <v-col>
                        </v-col>
                        <v-col v-show="var_showScreen == 'login'">
                           <div class="text-center">
                              <v-btn
                                 class="ma-2"
                                 outlined
                                 color="primary"
                                 @click="changeshow()"
                              >
                                 REGISTRARSE
                              </v-btn>
                           </div>
                        </v-col>
                     </v-row>
                  </v-card>
               </v-flex>
            </v-layout>
         </v-container>
      </v-main>
   </v-app>
</template>

<script>
import axios from "axios";

export default {
   name: 'Login',

   data() {
      return {
         var_showScreen: 'login',
         
         var_form: null,
         var_name: null,
         var_email: null,
         var_password: null,
         var_confirm_password: null,
         var_sub_type: null,
         
         rules: {
            required: (value) => !!value || "Campo requerido.",
            email: (value) => {
               const pattern =
                  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
               return pattern.test(value) || "Formato de email invalido.";
            },
            confirm: (value) => value == this.var_password || "Las contraseñas no coinciden.",
         },
      }
   },

   methods: {
      changeshow: function ()
         {
            this.var_showScreen = this.var_showScreen == 'login' ? 'signup' : 'login';
            this.var_form = null;
            this.var_name = null;
            this.var_email = null;
            this.var_password = null;
            this.var_sub_type = null;
         },

      login: function ()
        {
            let Self = this;
            
            let credenciales = {
                email: this.var_email,
                password: this.var_password,
            };

            axios
                .post("/api/user/login", credenciales)
                .then((response) => {
                    this.usuario = response.data[0];
                    
                    Self.$store.dispatch("setLogin", () => {
                        Self.$router.push("/home").catch((err) => err);
                    });
                })
                .catch((error) => {
                    alert("Usuario y/o contraseña incorrectos");
                });
        },
        
      signUp: function ()
        {
            let credenciales = {
                username: this.var_name,
                email: this.var_email,
                password: this.var_password,
                sub_type: this.var_sub_type,
            };

            axios
                .post("/api/user/signUp", credenciales)
                .then((response) => {
                    alert("Usuario Creado Correctamente");
                    this.var_showScreen = 'login';
                })
                .catch((error) => {
                    alert("Error al crear el Usuario");
                });
        },
   }

};
</script>