<template>
   <v-app id="inspire">
      <v-main>
         <v-container fluid fill-height>
            <v-layout align-center justify-center>
               <v-flex md8>
                  <v-card class="elevation-12">
                     <v-row>
                        <v-col>
                           <img width="100%" height="auto" src="images/login.png"/>
                        </v-col>
                        <v-col v-if="var_showScreen == null"><!--INICIO-->
                           <v-container fluid fill-height>
                              <v-layout align-center justify-center>
                                 <v-flex md8>
                                    <v-row>
                                       <v-col cols="1"></v-col>
                                       <v-col cols="5">
                                          <v-btn text @click="var_showScreen = 'login'"><v-icon style="font-size:6em">login</v-icon></v-btn><br><br>
                                          <v-btn text @click="var_showScreen = 'login'">INICIAR SESION</v-btn>
                                       </v-col>
                                       <v-col cols="5">
                                          <v-btn text @click="var_showScreen = 'signUp'"><v-icon style="font-size:6em">person_add</v-icon></v-btn><br><br>
                                          <v-btn text @click="var_showScreen = 'signUp'">REGISTRARSE</v-btn>
                                       </v-col>
                                       <v-col cols="1"></v-col>
                                    </v-row>
                                 </v-flex>
                              </v-layout>
                           </v-container>
                        </v-col>
                        <v-col v-if="var_showScreen == 'signUp'"><!--REGISTRAR USUARIO-->
                           <span align="center"><h1>REGISTRARSE</h1></span>
                           <v-form ref="form" v-model="var_form_signUp_valid">
                              <v-row class="mt-2"> <!--ROL-->
                                 <v-col cols="1"></v-col>
                                 <v-col cols="5">
                                    <v-btn width="100%" :color="var_user_role === 'Entrenador' ? 'primary' : 'light-grey'" @click="var_user_role = 'Entrenador'">ENTRENADOR</v-btn>
                                 </v-col>
                                 <v-col cols="5">
                                    <v-btn width="100%" :color="var_user_role === 'Director' ? 'primary' : 'light-grey'" @click="var_user_role = 'Director'">DIRECTOR DEPORTIVO</v-btn>
                                 </v-col>
                                 <v-col cols="1"></v-col>
                              </v-row>
                              <v-row class="mt-2"> <!--CANTIDAD-->
                                 <v-spacer></v-spacer>
                                 <v-col cols="3">
                                    <v-btn width="100%" :color="var_user_max_teams === 1 ? 'primary' : 'light-grey'" @click="var_user_max_teams = 1">1 Equipo <br> 10€/Año</v-btn>
                                 </v-col>
                                 <v-col cols="3">
                                    <v-btn width="100%" :color="var_user_max_teams === 2 ? 'primary' : 'light-grey'" @click="var_user_max_teams = 2">2 Equipos <br> 15€/Año</v-btn>
                                 </v-col>
                                 <v-col cols="3">
                                    <v-btn width="100%" :color="var_user_max_teams === 3 ? 'primary' : 'light-grey'" @click="var_user_max_teams = 3">3 Equipos <br> 20€/Año</v-btn>
                                 </v-col>
                                 <v-spacer></v-spacer>
                              </v-row>
                              <v-row class="mt-2"><!--NOMBRE-->
                                 <v-spacer></v-spacer>
                                 <v-col cols="10">
                                    <v-text-field
                                       v-model="var_user_name"
                                       label="Nombre Completo"
                                       clearable
                                       required
                                       prepend-icon="person"
                                    ></v-text-field>
                                 </v-col>
                                 <v-spacer></v-spacer>
                              </v-row>
                              <v-row class="mt-0"><!--EMAIL-->
                                 <v-spacer></v-spacer>
                                 <v-col cols="10">
                                    <v-text-field
                                       v-model="var_user_email"
                                       label="Correo Electrónico"
                                       clearable
                                       required
                                       prepend-icon="mail"
                                       :rules="rules.email"
                                    ></v-text-field>
                                 </v-col>
                                 <v-spacer></v-spacer>
                              </v-row>
                              <v-row class="mt-0"><!--CONTRASEÑA-->
                                 <v-spacer></v-spacer>
                                 <v-col cols="5">
                                    <v-text-field
                                    v-model="var_user_password"
                                       type="password"
                                       label="Contraseña"
                                       prepend-icon="lock"
                                       required
                                       clearable
                                    ></v-text-field>
                                 </v-col>
                                 <v-col cols="5">
                                    <v-text-field
                                    v-model="var_confirm_user_password"
                                       type="password"
                                       label="Confirmar Contraseña"
                                       prepend-icon="lock"
                                       required
                                       clearable
                                       :rules="[rules.required, rules.confirm]"
                                    ></v-text-field>
                                 </v-col>
                                 <v-spacer></v-spacer>
                              </v-row>
                              <v-row><!--REGISTRARSE-->
                                 <v-col cols="1"></v-col>
                                 <v-col cols="3">
                                    <v-btn width="100%" color="primary" @click="changeshow()">VOLVER</v-btn>
                                 </v-col>
                                 <v-col cols="4"></v-col>
                                 <v-col cols="3">
                                    <v-btn width="100%" color="primary" :disabled="!var_form_signUp_valid">REGISTRARSE</v-btn>
                                 </v-col>
                                 <v-col cols="1"></v-col>
                              </v-row>
                           </v-form>
                        </v-col>
                        <v-col v-if="var_showScreen == 'login'"><!--INICIAR SESION-->
                           <span align="center"><h1>INICIAR SESION</h1></span>  
                           <v-form ref="form" v-model="var_form_login_valid">
                              <v-row class="mt-0"><!--EMAIL-->
                                 <v-spacer></v-spacer>
                                 <v-col cols="10">
                                    <v-text-field
                                       v-model="var_user_email"
                                       label="Correo Electrónico"
                                       clearable
                                       required
                                       prepend-icon="mail"
                                       :rules="rules.email"
                                    ></v-text-field>
                                 </v-col>
                                 <v-spacer></v-spacer>
                              </v-row>
                              <v-row clas="mt-0"><!--CONTRASEÑA---->
                                 <v-spacer></v-spacer>
                                 <v-col cols="10">
                                    <v-text-field
                                       v-model="var_user_password"
                                       type="password"
                                       label="Contraseña"
                                       prepend-icon="lock"
                                       required
                                       clearable
                                    ></v-text-field>
                                 </v-col>
                                 <v-spacer></v-spacer>
                              </v-row>
                              <v-row><!--INICIAR SESION-->
                                 <v-col cols="1"></v-col>
                                 <v-col cols="3">
                                    <v-btn width="100%" color="primary" @click="changeshow()">VOLVER</v-btn>
                                 </v-col>
                                 <v-col cols="4"></v-col>
                                 <v-col cols="3">
                                    <v-btn width="100%" color="primary" :disabled="!var_form_signUp_valid">INICIAR SESION</v-btn>
                                 </v-col>
                                 <v-col cols="1"></v-col>
                              </v-row>
                           </v-form>
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
   name: 'Index',

   data() {
      return {
         var_showScreen: null,
         
         var_form_signUp_valid: null,
         var_form_login_valid: null,
         var_user_role: "Entrenador",
         var_user_max_teams: 1,

         var_user_name: null,
         var_user_email: null,
         var_user_password: null,
         var_confirm_user_password: null,
         
         rules: {
            required: (value) => !!value || "Campo requerido.",
            email: [ 
               v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'El Correo Electrónico debe ser una dirección valida'
            ],
            confirm: (value) => value == this.var_user_password || "Las contraseñas no coinciden.",
         },
      }
   },

   methods: {
      changeshow: function ()
         {
            this.var_showScreen = null;
            this.var_form_signUp_valid = null;
            this.var_form_login_valid = null;
            this.var_user_role = "Entrenador";
            this.var_user_max_teams = 1;

            this.var_user_name = null;
            this.var_user_email = null;
            this.var_user_password = null;
            this.var_confirm_user_password = null;
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